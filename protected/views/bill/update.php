<?php if ($result != null) { ?>
    <div style="padding:10px; background-color:#dff0d8; color:#3c763d;"><?= $result; ?></div>
<?php } ?>

<h1>แก้ไขใบวางบิล <?php echo $model->billId; ?></h1>

<?php echo $this->renderPartial('_form', array('model' => $model)); ?>

<h1>รายละเอียดใบวางบิล</h1>

<form method="POST">
    <input type="hidden" name="BillDetail[billId]" value="<?= $model->billId; ?>" />

    <?php
    //echo CHtml::dropDownList('RelateTaxProduct[productId]', '', CHtml::listData(Product::model()->findAll(array('condition' => 'active = 1', 'order' => 'name asc')), 'productId', 'name'));
    ?>
    เลขที่
    <input type="text" name="BillDetail[no]" value="1" style="width:100px;" />
    วันที่

    <?php
    $this->widget('zii.widgets.jui.CJuiDatePicker', array(
        'name' => 'BillDetail[date]',
        'value' => $model->dateCreate,
        // additional javascript options for the date picker plugin
        'options' => array(
            'showAnim' => 'fold',
            'dateFormat' => 'yy-mm-dd'
        ),
        'htmlOptions' => array(
            'style' => 'height:20px;',
        ),
    ));
    ?>
    ราคา
    <input type="text" name="BillDetail[price]" value="0" style="width:100px;" />

    หมายเหตุ
    <input type="text" name="BillDetail[remark]" value="" style="width:100px;" />
    <input type="submit" value="เพิ่ม" class="btn btn-success"/>
</form>

<?php
$this->widget('bootstrap.widgets.TbGridView', array(
    'id' => 'quotation-grid',
    'dataProvider' => $billDetail,
    'enableSorting' => false,
    'ajaxUpdate' => false,
    'columns' => array(
        array(
            'name' => 'เลขที่',
            'value' => '$data->no',
        ),
        array(
            'name' => 'วันที่',
            'value' => '$data->date',
        ),
        array(
            'name' => 'จำนวนเงิน',
            'value' => '$data->price',
        ),
        array(
            'name' => 'หมายเหตุ',
            'value' => '$data->remark',
        ),
        array(
            'class' => 'bootstrap.widgets.TbButtonColumn',
            'htmlOptions' => array('width' => '80px'),
            'template' => '{update} {delete}',
            'buttons' => array(
                'update' => array(
                    'url' => 'Yii::app()->createUrl("/billdetail/update", array(
                        "id" => $data->billDetailId,
                        "url" => Yii::app()->request->hostInfo.Yii::app()->request->url,
                    ))',
                ),
                'delete' => array(
                    'url' => 'Yii::app()->createUrl("/billdetail/delete", array("id" => $data->billDetailId))',
                ),
            ),
        ),
    ),
));
?>
<br>
<h1>แสดงตัวอย่างใบวางบิล</h1>
<div style="text-align: center;margin-bottom: 10px;">
    <a href="<?= Yii::app()->createUrl("/bill/pdf", array("id" => $model->billId)); ?>" target="_blank"><button class="btn btn-success">Print</button></a>
</div>
<div style="width:800px;text-align:center;margin: 0 auto;margin-bottom:20px;border-style: solid;
     border-width: 1px;border-color:black;padding:20px;height:1100px">
    <table cellspacing="0" cellpadding="0" border="0" width="100%">
        <tr>
            <td style="width:120px"></td>
            <td style="text-align:center;" colspan="2">
                <b style="font-size:16">รุ่งปิติพร การทอ (สำนักงานใหญ่)</b><br>
                149.151 ซอยเพชรเกษม 42 แยก 1 แขวงบางจาก เขตภาษีเจริญ<br>
                กรุงเทพมหานคร โทร. 0-2869-5155 แฟ็กซ์ 0-2869-8042<br>
                เลขประจำตัวผู้เสียภาษีอากร 3140600008006<br><br>
            </td>
            <td style="vertical-align:top;text-align:middle;"><b>เลขที่: <?= $model->billNumber; ?></b></td>
        </tr>
        <tr style="font-size:16;">
            <td></td>
            <td><b>ใบวางบิล</b></td>
            <td></td>
        </tr>
    </table><br>
    <table width="100%">
        <tr><td width="500px" >
                <table cellspacing="0" cellpadding="1" border="0" width="100%">
                    <tr>
                        <td width="500px" style="text-align:left;"><b>ชื่อผู้ซื้อ:</b> <?= $model->companyName; ?> (สำนักงานใหญ่)</td>

                    </tr>

                </table>
            </td>

            <td>
                <table cellspacing="0" cellpadding="1" border="0" width="100%">
                    <tr>
                        <td style="text-align:left;"><b>วันที่: </b>&nbsp&nbsp <?= DateManager::convertThaiYear($model->dateCreate); ?></td>

                    </tr>
                    
                </table>
            </td>
        </tr>

    </table>

    <div style="text-align:center;"></div>
    <br>


    <table width="100%">
        <thead>
            <tr style="font-weight:bold;text-align:center;border: 1px solid black;">
                <td width="50px" style="border-right: 1px solid black;">ลำดับที่</td>
                <td width="250px" style="border-right: 1px solid black;">เลขที่</td>

                <td width="120px" style="border-right: 1px solid black;">วันที่</td>
                <td colspan="2" style="border-right: 1px solid black;">จำนวนเงิน</td>
                <td width="150px" style="border-right: 1px solid black;">หมายเหตุ</td>
            </tr>
        </thead>

        <?
        $models = $billDetail->getData();
        $total = 0;
        $k = 0;

        $count =  count($models);

        if($count <= 19)
            $count = 19;


        for ($i = 0; $i < $count; $i++) {
            ?>

            <tr style="height:32px;font-weight:bold;">
                <td width="50px" style="text-align:center;padding:5px;border-right: 1px solid black;border-left: 1px solid black;"><? if (isset($models[$i])) echo $i + 1; ?></td>
                <td width="250px" style="text-align:left;padding:5px;border-right: 1px solid black;border-left: 1px solid black;"><? if (isset($models[$i])) echo $models[$i]->no; ?></td>

                <td width="120px" style="text-align:center;padding:5px;border-right: 1px solid black;border-left: 1px solid black;"><? if (isset($models[$i])) echo date("j",strtotime($models[$i]->date))."/".date("n",strtotime($models[$i]->date))."/".(date("Y",strtotime($models[$i]->date))+543); ?></td>
                <td width="80px" style="text-align:right;padding:5px;border-right: 1px solid black;border-left: 1px solid black;" style="text-align:center;"><? if (isset($models[$i])) echo substr(number_format($models[$i]->price, 2, ".", ","),0,-3); ?></td>
                <td width="20px" style="text-align:right;padding:5px;border-right: 1px solid black;border-left: 1px solid black;" style="text-align:center;"><? if (isset($models[$i])) {if(substr(number_format($models[$i]->price, 2, ".", ","), -2) == 00) echo "-"; else echo substr($models[$i]->price,-2); }?></td>
                <td width="150px" style="text-align:left;padding:5px;border-right: 1px solid black;border-left: 1px solid black;"><? if (isset($models[$i])) echo $models[$i]->remark; ?></td>
            </tr>

            <?
            if (isset($models[$i])) {
                $total += $models[$i]->price;
                $k++;
            }
        }
        ?>


<? $texttotal = '(' . CurrencyManager::ThaiBahtConversion(str_replace(",", "", ($total * 7 / 100) + $total)) . ')'; ?>
    </table>
    <table width="100%" style="font-weight:bold;">
        <tr nobr="true">
            <td width="350px" style="text-align:center;border-top: 1px solid black;"><b>รวม <?= $k; ?> ฉบับ<br><br>จำนวนเงินรวมทั้งสิ้น (ตัวอักษร)</b> <br><table style="width:95%;" border="1"><tr><td style="text-align:center;"><?= $texttotal ?></td></tr></table></td>
            <td width="140px" style="text-align:right;border-left: 1px solid black;border-bottom: 1px solid black;border-top: 1px solid black;"><b> 
                    <!-- รวมราคาสินค้าทั้งสิ้น<br> 
                    จำนวนภาษีมูลค่าเพิ่ม 7%<br>  -->
                    รวมเป็นเงินทั้งสิ้น
                </b></td>
            <td width="96px" style="text-align:right;border-left: 1px solid black;border-bottom: 1px solid black;border-top: 1px solid black;" > <?= substr(number_format($total, 2, ".", ","), 0, -3); ?>
<? //=number_format($total*7/100, 2, ".", ","); ?>
<? //=number_format(($total*7/100)+$total, 2, ".", ","); ?>
            </td>
            <td width="30px" style="text-align:right;border-left: 1px solid black;border-bottom: 1px solid black;border-top: 1px solid black;" > 
            <?
                if (substr(number_format($total, 2, ".", ","), -2) == 00)
                    echo "-";
                else
                    echo substr(number_format($total, 2, ".", ","), -2);

            ?>
            </td>
            <td width="174px" style="text-align:right;border-left: 1px solid black;border-right: 1px solid black;border-bottom: 1px solid black;border-top: 1px solid black;" > 
            </td>
        </tr>
    </table><br>

    <table cellspacing="0" cellpadding="1" border="1" style="text-align:center;font-weight:bold;" nobr="true" width="100%"> 

        <tr>
            <td style="width:250px"><br><br><br>
                .............................................................<br><br>
                นัดชำระ           

                <br>

            </td>
            <td style="width:250px"><br><br><br>
                .............................................................<br><br>
                ผู้วางใบ      
                <br>
              

            </td>
            <td style="width:250px"><br><br><br>
                .............................................................<br><br>
                ผู้รับวางบิล      
                <br>
                
            </td>
        </tr>
    </table>
</div>