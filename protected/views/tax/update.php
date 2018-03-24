<?php if ($result != null) { ?>
    <div style="padding:10px; background-color:#dff0d8; color:#3c763d;"><?= $result; ?></div>
<?php } ?>

<h1>แก้ไขใบกำกับภาษีเลขที่ <?php echo $model->taxNumber; ?></h1>

<?php echo $this->renderPartial('_form', array('model' => $model)); ?>

<h1>รายละเอียดใบกำกับภาษี</h1>
<form method="POST">
    <input type="hidden" name="RelateTaxProduct[taxId]" value="<?= $model->taxId; ?>" />
    ชื่อสินค้า
    <?php
    echo CHtml::dropDownList('RelateTaxProduct[productId]', $productId, CHtml::listData(Product::model()->findAll(array('condition' => 'active = 1', 'order' => 'name asc')), 'productId', 'name'), array(
        'ajax' => array(
            'type' => 'POST',
            'url' => CController::createUrl('ajaxGetPrice'),
            'data' => array('productId' => 'js:this.value'),
            'success' => 'function(data){ $("#pricePerAmount").val(data) }',
        )
    ));
    ?>
    ราคาต่อหน่วย(โหล)
    <input type="text" name="RelateTaxProduct[pricePerAmount]"  id="pricePerAmount" value="<?= $priceFirstProduct; ?>" style="width:40px;" />
    จำนวน
    <input type="text" name="RelateTaxProduct[amount]" value="1" style="width:40px;" />
    <input type="submit" value="เพิ่มสินค้า" class="btn btn-success"/>
</form>

<?php
$this->widget('bootstrap.widgets.TbGridView', array(
    'id' => 'quotation-grid',
    'dataProvider' => $relateTaxProductData,
    'enableSorting' => false,
    'ajaxUpdate' => false,
    'columns' => array(
        array(
            'name' => 'productName',
            'value' => '$data->product->name',
        ),
        array(
            'name' => 'amount',
            'value' => '$data->escape_decimal($data->amount)',
        ),
        array(
            'name' => 'price',
            'value' => 'number_format($data->pricePerAmount*$data->amount, 2, ".", ",")',
        ),
        array(
            'class' => 'bootstrap.widgets.TbButtonColumn',
            'htmlOptions' => array('width' => '80px'),
            'template' => '{update} {delete}',
            'buttons' => array(
                'update' => array(
                    'url' => 'Yii::app()->createUrl("/relatetaxproduct/update", array(
                        "id" => $data->relate_tax_productId,
                        "taxId" => $data->taxId,
                        "url" => Yii::app()->request->hostInfo.Yii::app()->request->url,
                    ))',
                ),
                'delete' => array(
                    'url' => 'Yii::app()->createUrl("/relatetaxproduct/delete", array(
                        "id" => $data->relate_tax_productId,
                        "url" => Yii::app()->request->hostInfo.Yii::app()->request->url,
                    ))',
                ),
            ),
        ),
    ),
));
?>
<br>
<h1>แสดงตัวอย่างใบกำกับภาษี</h1>
<div style="text-align: center;margin-bottom: 10px;">
    <a href="<?= Yii::app()->createUrl("/tax/pdf", array("id" => $model->taxId)); ?>" target="_blank"><button class="btn btn-success">Print</button></a>
</div>
<div style="width:800px;text-align:center;margin: 0 auto;margin-bottom:20px;border-style: solid;
     border-width: 1px;border-color:black;padding:20px;height:1100px">
    <table cellspacing="0" cellpadding="0" border="0" width="100%">
        <tr>
            <td style="width:120px"></td>
            <td style="text-align:center;" >
                <b style="font-size:16">รุ่งปิติพร การทอ (สำนักงานใหญ่)</b><br>
                149.151 ซอยเพชรเกษม 42 แยก 1 แขวงบางจาก เขตภาษีเจริญ<br>
                กรุงเทพมหานคร โทร. 0-2869-5155 แฟ็กซ์ 0-2869-8042<br>
                เลขประจำตัวผู้เสียภาษีอากร 3140600008006<br><br>
            </td>
            <td style="vertical-align:top;text-align:middle;"><b>เลขที่: <?= $model->taxNumber; ?></b></td>
        </tr>
        <tr style="font-size:16;">
            <td></td>
            <td ><b>ใบส่งสินค้า/ใบกำกับภาษี</b></td>
            <td></td>
        </tr>
    </table><br>
    <table width="100%">
        <tr><td width="500px" >
                <table cellspacing="0" cellpadding="1" border="0" width="100%">
                    <tr>
                        <td width="500px" style="text-align:left;"><b>ชื่อผู้ซื้อ:</b> <?= $model->customer->name; ?> (สำนักงานใหญ่)</td>

                    </tr>
                    <tr>
                        <td width="500px" style="text-align:left;"><b>ที่อยู่:</b> <?= $model->customer->address; ?></td>

                    </tr>
                    <tr>
                        <td width="500px" style="text-align:left;"><b>เลขประจำตัวผู้เสียภาษีอากร:</b> <?= $model->customer->vatId; ?></td>

                    </tr>
                </table>
            </td>

            <td>
                <table cellspacing="0" cellpadding="1" border="0" width="100%">
                    <tr>
                        <td style="text-align:left;"><b>วันที่: </b>&nbsp&nbsp <?= date("j", strtotime($model->dateCreate)); ?>/<?= date("n", strtotime($model->dateCreate)); ?>/<?= date("Y", strtotime($model->dateCreate)) + 543; ?></td>

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
    <br>


    <table width="100%">
        <thead>
            <tr style="font-weight:bold;text-align:center;border: 1px solid black;">
                <td width="50px" style="border-right: 1px solid black;">ลำดับที่</td>
                <td width="300px" style="border-right: 1px solid black;">รายการ</td>

                <td width="120px" style="border-right: 1px solid black;">จำนวนหน่วย (โหล)</td>
                <td width="100px" colspan="2" style="border-right: 1px solid black;">ราคาต่อหน่วย</td>

                <td width="100px" colspan="2" style="border-right: 1px solid black;">จำนวนเงิน </td>
            </tr>
        </thead>

        <?
        $models = $relateTaxProductData->getData();
        $total = 0;

        $count = count($models);

        if ($count <= 13)
            $count = 13;


        for ($i = 0; $i < $count; $i++) {
            ?>

            <tr style="height:35px;font-weight:bold;">
                <td width="50px" style="text-align:center;padding:5px;border-right: 1px solid black;border-left: 1px solid black;"><? if (isset($models[$i])) echo $i + 1; ?></td>
                <td width="300px" style="text-align:left;padding:5px;border-right: 1px solid black;border-left: 1px solid black;"><? if (isset($models[$i])) echo $models[$i]->product->name; ?></td>

                <td width="120px" style="text-align:center;padding:5px;border-right: 1px solid black;border-left: 1px solid black;">
                    <?php
                    if (isset($models[$i])) {
                        if (is_numeric($models[$i]->amount) && floor($models[$i]->amount) != $models[$i]->amount) {
                            echo $models[$i]->amount;
                        } else {
                            echo round($models[$i]->amount);
                        }
                    }
                    ?>
                </td>
                <td width="100px" style="text-align:right;padding:5px;border-right: 1px solid black;border-left: 1px solid black;" style="text-align:center;"><? if (isset($models[$i])) echo substr(number_format($models[$i]->pricePerAmount, 2, ".", ","), 0, -3); ?></td>
                <td width="20px" style="text-align:right;padding:5px;border-right: 1px solid black;border-left: 1px solid black;" style="text-align:center;"><?
                    if (isset($models[$i])) {
                        if (substr(number_format($models[$i]->pricePerAmount, 2, ".", ","), -2) == 00)
                            echo "-";
                        else
                            echo substr(number_format($models[$i]->pricePerAmount, 2, ".", ","), -2);
                    }
                    ?></td>
                <td width="80px" style="text-align:right;padding:5px;border-right: 1px solid black;border-left: 1px solid black;"><? if (isset($models[$i])) echo substr(number_format($models[$i]->pricePerAmount * $models[$i]->amount, 2, ".", ","), 0, -3); ?></td>
                <td width="20px" style="text-align:right;padding:5px;border-right: 1px solid black;border-left: 1px solid black;"><?
                    if (isset($models[$i])) {
                        if (substr(number_format($models[$i]->pricePerAmount * $models[$i]->amount, 2, ".", ","), -2) == 00)
                            echo "-";
                        else
                            echo substr(number_format($models[$i]->pricePerAmount * $models[$i]->amount, 2, ".", ","), -2);
                    }
                    ?></td>
            </tr>
            <?
            if (isset($models[$i]))
                $total += $models[$i]->pricePerAmount * $models[$i]->amount;
        }
        ?>


        <? $texttotal = '(' . CurrencyManager::ThaiBahtConversion(str_replace(",", "", ($total * 7 / 100) + $total)) . ')'; ?>
    </table>
    <table width="100%" style="font-weight:bold;">
        <tr nobr="true">
            <td  width="339px" style="text-align:center;padding: 0px;border-top: 1px solid black;"> <br><br><b>จำนวนเงินรวมทั้งสิ้น (ตัวอักษร)</b> <br><table style="width:95%;" border="1"><tr><td style="text-align:center;"><?= $texttotal ?></td></tr></table></td>
            <td  width="238px" style="text-align:right;padding:5px;border-left: 1px solid black;border-bottom: 1px solid black;border-top: 1px solid black;"><b> 
                    รวมราคาสินค้าทั้งสิ้น<br> 
                    จำนวนภาษีมูลค่าเพิ่ม 7%<br> 
                    รวมเป็นเงินทั้งสิ้น
                </b></td>
            <td width="72px" style="text-align:right;padding:5px;border-left: 1px solid black;border-bottom: 1px solid black;border-top: 1px solid black;" > <?= substr(number_format($total, 2, ".", ","), 0, -3); ?><br>
                <?= substr(number_format($total * 7 / 100, 2, ".", ","), 0, -3); ?><br>
                <?= substr(number_format(($total * 7 / 100) + $total, 2, ".", ","), 0, -3); ?>
            </td>
            <td width="17px" style="text-align:right;padding:5px;border-left: 1px solid black;border-right: 1px solid black;border-bottom: 1px solid black;border-top: 1px solid black;" > 
                <?
                if (substr(number_format($total, 2, ".", ","), -2) == 00)
                    echo "-";
                else
                    echo substr(number_format($total, 2, ".", ","), -2);
                ?><br>
                <?
                if (substr(number_format($total * 7 / 100, 2, ".", ","), -2) == 00)
                    echo "-";
                else
                    echo substr(number_format($total * 7 / 100, 2, ".", ","), -2);
                ?><br>
                <?
                if (substr(number_format(($total * 7 / 100) + $total, 2, ".", ","), -2) == 00)
                    echo "-";
                else
                    echo substr(number_format(($total * 7 / 100) + $total, 2, ".", ","), -2);
                ?>
            </td>
        </tr>
    </table><br>
    <div style="text-align:center;">ได้รับสินค้าดังรายการข้างต้น ในสภาพที่ดีไว้ถูกต้องเรียบร้อยแล้ว ในนาม <b>รุ่งปิติพร การทอ</b></div><br>
    <table cellspacing="0" cellpadding="1" border="1" style="text-align:center;font-weight:bold;" nobr="true" width="100%"> 
        <tr>
            <td style="width:250px"><br><br><br>
                .............................................................<br><br>
                ผู้รับสินค้า           

                <br>

            </td>
            <td style="width:250px"><br><br><br>
                .............................................................<br><br>
                วันที่รับสินค้า         
                <br>

            </td>
            <td style="width:250px"><br><br><br>
                .............................................................<br><br>
                ผู้จัดการ      
                <br>

            </td>
        </tr>
    </table>
</div>