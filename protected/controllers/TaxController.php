<?php

class TaxController extends Controller {

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
        $model = new Tax;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Tax'])) {
            $model->attributes = $_POST['Tax'];
            $model->taxNumber = IDManager::genDisplayId('taxId');
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
        $relateTaxProductModel = new RelateTaxProduct;
        $result = null;
        $productId = '';
        if (isset($_POST['RelateTaxProduct'])) {
            $productId = $_POST['RelateTaxProduct']['productId'];
            $productData = $relateTaxProductModel->findByAttributes(array(
                'taxId' => $id,
                'productId' => $productId,
            ));
            if ($productData != null) {
                $productData->amount = $productData->amount + $_POST['RelateTaxProduct']['amount'];
                if ($productData->save()) {
                    $result = 'เพิ่มสินค้าเสร็จเรียบร้อย';
                }
            } else {
                $relateTaxProductModel->attributes = $_POST['RelateTaxProduct'];
                if ($relateTaxProductModel->save()) {
                    $result = 'เพิ่มสินค้าเสร็จเรียบร้อย';
                }
            }
            $productModel = Product::model()->findByPk($productId);

            $model->totalPrice += ($_POST['RelateTaxProduct']['pricePerAmount'] * $_POST['RelateTaxProduct']['amount']);
            $model->save();
        }

        $criteria = new CDbCriteria;
        $criteria->addCondition('taxId = ' . $id);
        $relateTaxProductData = new CActiveDataProvider('RelateTaxProduct', array(
            'criteria' => $criteria,
            'pagination' => array('pageSize' => 15),
        ));

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Tax'])) {
            $model->attributes = $_POST['Tax'];
            if ($model->save()) {
                $result = 'บันทึกข้อมูลเสร็จเรียบร้อย';
            }
        }

        $productModel = Product::model()->find(array('condition' => 'active = 1', 'order' => 'name asc'));
        $priceFirstProduct = $productModel->price;

        $this->render('update', array(
            'model' => $model,
            'relateTaxProductData' => $relateTaxProductData,
            'result' => $result,
            'productId' => $productId,
            'priceFirstProduct' => $priceFirstProduct,
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
            //$this->loadModel($id)->delete();
            Tax::model()->updateByPk($id, array(
                'active' => 0,
            ));

            // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
            if (!isset($_GET['ajax']))
                $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
        } else
            throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');
    }

    /**
     * Lists all models.
     */
    public function actionIndex() {
        $dataProvider = new CActiveDataProvider('Tax');
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $model = new Tax('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Tax'])) {
            $model->attributes = $_GET['Tax'];
        }
        if (isset($_POST['Tax'])) {
            $model->dateCreate = $_POST['Tax']['dateCreate'];
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
        $model = Tax::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param CModel the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'tax-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    public function actionAjaxGetPrice() {
        $productId = Yii::app()->getRequest()->getParam('productId');
        $productModel = Product::model()->findByPk($productId);
        echo $productModel->price;
    }

    /**
     * PDF เอกสาร tax invoice
     *
     *
     */
    public function actionPdf() {
        $id = $_GET['id'];
        $model = $this->loadModel($id);
        $criteria = new CDbCriteria;
        $criteria->addCondition('taxId = ' . $id);
        $relateTaxProductData = new CActiveDataProvider('RelateTaxProduct', array(
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
        $customername = $model->customer->name;
        $address = $model->customer->address;
        $vatId = $model->customer->vatId;
        $date = date("j", strtotime($model->dateCreate)) . "/" . date("n", strtotime($model->dateCreate)) . "/" . (date("Y", strtotime($model->dateCreate)) + 543);
        $taxNumber = $model->taxNumber;
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
        <td style="vertical-align:top;text-align:right;width:150px;"><b>เลขที่: $taxNumber</b></td>
    </tr>
    <tr style="font-size:16;">
        <td></td>
        <td style="text-align:center;width:320px"><b>ใบส่งสินค้า/ใบกำกับภาษี</b><br></td>
        <td></td>
    </tr>
</table>
<table width="100%" style="margin-top:100px">
<tr><td width="500px" >
<table cellspacing="0" cellpadding="1" border="0">
    <tr>
        <td width="500px" style="text-align:left;"><b>ชื่อผู้ซื้อ:</b> $customername (สำนักงานใหญ่)</td>
       
    </tr>
    <tr>
        <td width="500px" style="text-align:left;"><b>ที่อยู่:</b> $address</td>
        
    </tr>
    <tr>
        <td width="500px" style="text-align:left;"><b>เลขประจำตัวผู้เสียภาษีอากร:</b> $vatId</td>
       
    </tr>
</table>
</td>

<td>
<table cellspacing="0" cellpadding="1" border="0">
    <tr>
        <td style="text-align:left;"><b>วันที่: </b> $date</td>
       
    </tr>
    <tr>
        <td style="text-align:left;"><b>ใบสั่งซื้้อเลขที่:</b> </td>
     
    </tr>
    <tr>
        <td style="text-align:left;"><b>วันครบกำหนด:</b></td>
     
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
<td width="310px" style="border: 1px solid black;">รายการ</td>

<td width="110px" style="border: 1px solid black;">จำนวนหน่วย (โหล)</td>
<td width="110px" colspan="2" style="border: 1px solid black;">ราคาต่อหน่วย</td>
<td width="113px" colspan="2" style="border: 1px solid black;">จำนวนเงิน </td>
</tr>
</thead>
EOD;

        $models = $relateTaxProductData->getData();
        $total = 0;
        $count = count($models);

        if ($count <= 13)
            $count = 13;

        for ($i = 0; $i < $count; $i++) {

            $no = "";
            $amount = "";
            $pricepereach = "";
            $productname = "";
            $pricebaht = "";
            $pricesatang = "";
            $pricepereachbaht = "";
            $pricepereachsatang = "";

            if (isset($models[$i])) {
                $no = $i + 1;
                $productname = $models[$i]->product->name;
                $amount = $models[$i]->amount;
                if (is_numeric($amount) && floor($amount) != $amount) {
                    
                } else {
                    $amount = round($amount);
                }
                $pricepereachbaht = substr(number_format($models[$i]->pricePerAmount, 2, ".", ","), 0, -3);
                if (substr(number_format($models[$i]->pricePerAmount, 2, ".", ","), -2) == 00)
                    $pricepereachsatang = "-";
                else
                    $pricepereachsatang = substr(number_format($models[$i]->pricePerAmount, 2, ".", ","), -2);
                $pricebaht = substr(number_format($models[$i]->pricePerAmount * $models[$i]->amount, 2, ".", ","), 0, -3);
                if (substr(number_format($models[$i]->pricePerAmount * $models[$i]->amount, 2, ".", ","), -2) == 00)
                    $pricesatang = "-";
                else
                    $pricesatang = substr(number_format($models[$i]->pricePerAmount * $models[$i]->amount, 2, ".", ","), -2);
            }
            $tbl .= <<<EOD
<tr style="font-weight:bold;">
<td width="50px" style="text-align:center;border-right: 1px solid black;border-left: 1px solid black;">$no</td>
<td width="310px" style="text-align:left;border-right: 1px solid black;"> $productname</td>

<td width="110px" style="text-align:center;border-right: 1px solid black;">$amount</td>
<td  width="80px" style="text-align:right;border-right: 1px solid black;" > $pricepereachbaht</td>
<td  width="30px" style="text-align:right;border-right: 1px solid black;" > $pricepereachsatang</td>
<td  width="80px" style="text-align:right;border-right: 1px solid black;"> $pricebaht</td>
<td  width="33px" style="text-align:right;border-right: 1px solid black;"> $pricesatang</td>
</tr>
EOD;
            if (isset($models[$i]))
                $total += $models[$i]->pricePerAmount * $models[$i]->amount;
        }

        $totalstring = substr(number_format($total, 2, ".", ","), 0, -3);
        $vattotal = substr(number_format($total * 7 / 100, 2, ".", ","), 0, -3);
        $totalincludevat = substr(number_format(($total * 7 / 100) + $total, 2, ".", ","), 0, -3);

        //$texttotal = '(' . CurrencyManager::ThaiBahtConversion(str_replace(",", "", $totalincludevat)) . ')';

        $texttotal = '(' . CurrencyManager::ThaiBahtConversion(str_replace(",", "", ($total * 7 / 100) + $total)) . ')';
        if (substr(number_format($total, 2, ".", ","), -2) == 00)
            $totalstringsatang = "-";
        else
            $totalstringsatang = substr(number_format($total, 2, ".", ","), -2);

        if (substr(number_format($total * 7 / 100, 2, ".", ","), -2) == 00)
            $vattotalsatang = "-";
        else
            $vattotalsatang = substr(number_format($total * 7 / 100, 2, ".", ","), -2);

        if (substr(number_format(($total * 7 / 100) + $total, 2, ".", ","), -2) == 00)
            $totalincludevatsatang = "-";
        else
            $totalincludevatsatang = substr(number_format(($total * 7 / 100) + $total, 2, ".", ","), -2);

        $tbl .= <<<EOD
            </table>
    <table width="100%" style="font-weight:bold;">
<tr nobr="true">
<td  width="360px" style="text-align:center;border-top: 1px solid black;"> <br><br><b>จำนวนเงินรวมทั้งสิ้น (ตัวอักษร)</b> <br><table style="width:95%;" border="1"><tr><td style="text-align:center;">$texttotal</td></tr></table></td>
<td  width="220px" style="text-align:right;border-left: 1px solid black;border-bottom: 1px solid black;border-top: 1px solid black;"><b> 
รวมราคาสินค้าทั้งสิ้น<br> 
จำนวนภาษีมูลค่าเพิ่ม 7%<br> 
รวมเป็นเงินทั้งสิ้น
</b></td>
<td  width="80px" style="text-align:right;padding:5px;border-left: 1px solid black;border-bottom: 1px solid black;border-top: 1px solid black;"> $totalstring<br>
 $vattotal<br>
 $totalincludevat
</td>
<td  width="33px" style="text-align:right;padding:5px;border-left: 1px solid black;border-right: 1px solid black;border-bottom: 1px solid black;border-top: 1px solid black;" > $totalstringsatang<br>
 $vattotalsatang<br>
 $totalincludevatsatang
</td>
</tr>
</table><br>
<div style="text-align:center;">ได้รับสินค้าดังรายการข้างต้น ในสภาพที่ดีไว้ถูกต้องเรียบร้อยแล้ว ในนาม <b>รุ่งปิติพร การทอ</b></div><br>
<table cellspacing="0" cellpadding="1" border="1" style="text-align:center;width:690px;font-weight:bold;" nobr="true"> 
    
    <tr>
        <td><br><br><br>
        ..................................................................<br><br>
        ผู้รับสินค้า          

<br>
                   
</td>
        <td><br><br><br>
        ..................................................................<br><br>
        วันที่รับสินค้า         
<br>
             
</td>
        <td><br><br><br>
        ..................................................................<br><br>
        ผู้จัดการ      
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
