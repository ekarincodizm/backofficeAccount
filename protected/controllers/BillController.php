<?php

class BillController extends Controller {

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id) {
        $this->render('view', array(
            'model' => $this->loadModel($id),
        ));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate() {
        $model = new Bill;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Bill'])) {
            $model->attributes = $_POST['Bill'];
            $model->billNumber = IDManager::genDisplayId('billId');
            if ($model->save())
                $this->redirect(array('admin'));
        }

        $this->render('create', array(
            'model' => $model,
        ));
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id) {
        $model = $this->loadModel($id);

        $billDetail = new Billdetail;
        $result = null;
        if (isset($_POST['BillDetail'])) {

            $billDetail->attributes = $_POST['BillDetail'];
            if ($billDetail->save()) {
                $result = 'เพิ่มสินค้าเสร็จเรียบร้อย';
            } else {
                $result = 'เพิ่มสินค้าไม่สำเร็จ';
            }
        }

        $criteria = new CDbCriteria;
        $criteria->addCondition('billId = ' . $id);
        $billDetail = new CActiveDataProvider('billDetail', array(
            'criteria' => $criteria,
            'pagination' => array('pageSize' => 5),
        ));

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Bill'])) {
            $model->attributes = $_POST['Bill'];
            if ($model->save())
                $result = 'บันทึกข้อมูลเสร็จเรียบร้อย';
        }

        $this->render('update', array(
            'model' => $model,
            'billDetail' => $billDetail,
            'result' => $result,
        ));
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($id) {
        if (Yii::app()->request->isPostRequest) {
            // we only allow deletion via POST request
            $this->loadModel($id)->delete();

            // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
            if (!isset($_GET['ajax']))
                $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
        }
        else
            throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');
    }

    /**
     * Lists all models.
     */
    public function actionIndex() {
        $dataProvider = new CActiveDataProvider('Bill');
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $model = new Bill('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Bill']))
            $model->attributes = $_GET['Bill'];
        if (isset($_POST['Bill'])) {
            $model->dateCreate = $_POST['Bill']['dateCreate'];
        }
        if (empty($model->dateCreate)) {
            $model->dateCreate = date('Y-m');
        }
        $this->render('admin', array(
            'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer the ID of the model to be loaded
     */
    public function loadModel($id) {
        $model = Bill::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param CModel the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'bill-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    public function actionPdf() {
        $id = $_GET['id'];
        $model = $this->loadModel($id);
        $criteria = new CDbCriteria;
        $criteria->addCondition('billId = ' . $id);
        $billDetail = new CActiveDataProvider('Billdetail', array(
            'criteria' => $criteria,
            'pagination' => array('pageSize' => 5),
        ));

        // Include the main TCPDF library (search for installation path).
        Yii::import('ext.tcpdf.*');
//require_once('tcpdf_include.php');
// create new PDF document
        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
        $pdf->SetCreator(PDF_CREATOR);
        /* $pdf->SetAuthor('Nicola Asuni');
          $pdf->SetTitle('TCPDF Example 048');
          $pdf->SetSubject('TCPDF Tutorial');
          $pdf->SetKeywords('TCPDF, PDF, example, test, guide');
         */
// set default header data
        $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE . ' 048', PDF_HEADER_STRING);

// set header and footer fonts
        $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
//$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
//$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
//$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
// set auto page breaks
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
        $pdf->SetPrintHeader(false);
        $pdf->SetPrintFooter(false);
// set JPEG quality
        $pdf->setJPEGQuality(75);

// ---------------------------------------------------------
// set font
        $pdf->SetFont('helvetica', 'B', 20);
// add a page
        $pdf->AddPage('P', 'LETTER');
//$pdf->Image('images/wk_logo.jpg', 10, 10, 20, 25, 'JPG', 'http://www.tcpdf.org', '', true, 150, '', false, false, 1, false, false, false);
//$pdf->Write(0, 'Example of HTML tables', '', 0, 'L', true, 0, false, false, 0);

        $pdf->SetFont('cordiaupc', '', 14, '', true);
        $customername = $model->companyName;
        ;

        $date = date("j", strtotime($model->dateCreate)) . "/" . date("n", strtotime($model->dateCreate)) . "/" . (date("Y", strtotime($model->dateCreate)) + 543);
        $billNumber = $model->billNumber;
        $tbl = <<<EOD
<table cellspacing="0" cellpadding="0" border="0" >
    <tr>
        <td style="width:170px"></td>
        <td style="text-align:center;width:320px">
            <b style="font-size:16">รุ่งปิติพร การทอ (สำนักงานใหญ่)</b><br>
            149.151 ซอยเพชรเกษม 42 แยก 1 แขวงบางจาก เขตภาษีเจริญ<br>
            กรุงเทพมหานคร โทร. 0-2869-5155 แฟ็กซ์ 0-2869-8042<br>
            เลขประจำตัวผู้เสียภาษีอากร 3140600008006<br>
        </td>
        <td style="vertical-align:top;text-align:right;width:150px;"><b>เลขที่: $billNumber</b></td>
    </tr>
    <tr style="font-size:16;text-align:center;">
    <td></td>
    <td><b>ใบวางบิล</b><br></td>
    <td></td>
    </tr>
</table>
<table width="100%" style="margin-top:100px">
<tr><td width="500px" >
<table cellspacing="0" cellpadding="1" border="0">
    <tr>
        <td width="500px" style="text-align:left;"><b>ชื่อผู้ซื้อ:</b> $customername (สำนักงานใหญ่)</td>
       
    </tr>
    
</table>
</td>

<td>
<table cellspacing="0" cellpadding="1" border="0">
    <tr>
        <td style="text-align:left;"><b>วันที่: </b> $date</td>
       
    </tr>

</table>
</td>
</tr>

</table>

<div style="text-align:center;"></div>
EOD;

        $pdf->writeHTML($tbl, true, false, false, false, '');

// -----------------------------------------------------------------------------

        $tbl = <<<EOD
<table width="100%">
<thead>
<tr style="font-weight:bold;text-align:center;">
<td width="50px" style="border: 1px solid black;">ลำดับที่</td>
<td width="200px" style="border: 1px solid black;">เลขที่</td>

<td width="120px" style="border: 1px solid black;">วันที่</td>
<td width="113px" style="border: 1px solid black;">จำนวนเงิน</td>
<td width="214px" style="border: 1px solid black;">หมายเหตุ</td>
</tr>
</thead>
EOD;

        $models = $billDetail->getData();
        $total = 0;
        $k = 0;

        $count =  count($models);

        if($count <= 19)
            $count = 19;

        for ($i = 0; $i < $count; $i++) {

            $no = "";
            $date = "";
            $number = "";
            $remark = "";
            $pricebaht = "";
            $pricesatang = "";

            if (isset($models[$i])) {
                $number = $i + 1;
                $no = $models[$i]->no;
                $date = date("j", strtotime($models[$i]->date)) . "/" . date("n", strtotime($models[$i]->date)) . "/" . (date("Y", strtotime($models[$i]->date)) + 543);
                $remark = $models[$i]->remark;
                $pricebaht = substr(number_format($models[$i]->price, 2, ".", ","), 0, -3);
                $pricesatang = substr(number_format($models[$i]->price, 2, ".", ","), -2);

                if (substr(number_format($models[$i]->price, 2, ".", ","), -2) == 00)
                    $pricesatang = "-";
                else
                    $pricesatang = substr(number_format($models[$i]->price, 2, ".", ","), -2);

                $total += $models[$i]->price;
                $k++;
            }
            $tbl .= <<<EOD
<tr style="font-weight:bold;">
<td width="50px" style="text-align:center;border-right: 1px solid black;border-left: 1px solid black;">$number</td>
<td width="200px" style="text-align:left;border-right: 1px solid black;"> $no</td>

<td width="120px" style="text-align:center;border-right: 1px solid black;">$date</td>
<td width="80px" style="text-align:right;border-right: 1px solid black;" > $pricebaht</td>
<td width="33px" style="text-align:right;border-right: 1px solid black;" > $pricesatang</td>
<td width="214px" style="text-align:left;border-right: 1px solid black;"> $remark</td>

</tr>
EOD;
        }

        $totalstring = substr(number_format($total, 2, ".", ","), 0, -3);
        $vattotal = substr(number_format($total * 7 / 100, 2, ".", ","), 0, -3);
        $totalincludevat = substr(number_format($total, 2, ".", ","), 0, -3);
        //$texttotal = '(' . CurrencyManager::ThaiBahtConversion(str_replace(",", "", $totalincludevat)) . ')';
        $texttotal = '(' . CurrencyManager::ThaiBahtConversion(str_replace(",", "", ($total * 7 / 100) + $total)) . ')';
        if (substr(number_format($total, 2, ".", ","), -2) == 00)
            $totalstringsatang = "-";
        else
            $totalstringsatang = substr(number_format($total, 2, ".", ","), -2);

        $tbl .= <<<EOD
</table>
<table width="100%" style="font-weight:bold;">
<tr nobr="true">
<td width="250px" style="text-align:center;border-top: 1px solid black;"> <br><br><b>จำนวนเงินรวมทั้งสิ้น (ตัวอักษร)</b> <br><table style="width:95%;" border="1"><tr><td style="text-align:center;"> $texttotal</td></tr></table></td>
<td width="120px" style="text-align:right;border-left: 1px solid black;border-bottom: 1px solid black;border-top: 1px solid black;"><b> 
รวมเป็นเงินทั้งสิ้น
</b></td>
<td width="80px" style="text-align:right;border-left: 1px solid black;border-bottom: 1px solid black;border-top: 1px solid black;"> $totalstring
</td>
<td width="33px" style="text-align:right;border-left: 1px solid black;border-bottom: 1px solid black;border-top: 1px solid black;"> $totalstringsatang
</td>
<td width="214px" style="text-align:right;border-left: 1px solid black;border-bottom: 1px solid black;border-right: 1px solid black;border-top: 1px solid black;">
</td>
</tr>
</table><br><br>
<table cellspacing="0" cellpadding="1" border="1" style="text-align:center;font-weight:bold;" nobr="true" width="100%"> 
    
    <tr>
        <td ><br><br><br>
        .............................................................<br><br>
        นัดชำระ           

<br><br>
                    
</td>
        <td ><br><br><br>
        .............................................................<br><br>
        ผู้วางใบ      
<br>

             
</td>
        <td ><br><br><br>
        .............................................................<br><br>
        ผู้รับวางบิล      
<br>
    
</td>
    </tr>
</table>
EOD;

        $pdf->writeHTML($tbl, true, false, false, false, '');

// -----------------------------------------------------------------------------
// -----------------------------------------------------------------------------
//Close and output PDF document
        $pdf->Output("test" . '.pdf', 'I');
//$pdf->Output('example_048.pdf', 'I');
//============================================================+
// END OF FILE
//============================================================+
    }

}
