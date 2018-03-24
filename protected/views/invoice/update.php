<?php if ($result != null) { ?>
    <div style="padding:10px; background-color:#dff0d8; color:#3c763d;"><?= $result; ?></div>
<?php } ?>

<h1>แก้ไขใบเสร็จรับเงินเลขที่ <?php echo $model->invoiceNumber; ?></h1>

<?php echo $this->renderPartial('_form', array('model' => $model)); ?>

<h1>รายละเอียดใบเสร็จรับเงิน</h1>
<form method="POST">
    <input type="hidden" name="RelateInvoiceTax[invoiceId]" value="<?= $model->invoiceId; ?>" />
    เลขที่ใบกำกับภาษี
    <?php
    echo CHtml::dropDownList('RelateInvoiceTax[taxId]', $taxId, CHtml::listData(Tax::model()->findAll(array(
                        'condition' => 'active = 1 and customerId = :customerId and dateCreate between :startDate and :endDate',
                        'order' => 'taxNumber asc',
                        'params' => array(
                            ':customerId' => $model->customerId,
                            'startDate' => date('Y-m', strtotime($model->dateCreate-1)).'-01',
                            'endDate' => date('Y-m', strtotime($model->dateCreate-1)).'-31',
                        )
                            )
                    ), 'taxId', 'taxNumber'));
    ?>
    <input type="submit" value="เพิ่มใบกำกับภาษี" class="btn btn-success"/>
</form>

<?php
$this->widget('bootstrap.widgets.TbGridView', array(
    'id' => 'quotation-grid',
    'dataProvider' => $relateInvoiceTaxData,
    'enableSorting' => false,
    'ajaxUpdate' => false,
    'columns' => array(
        array(
            'name' => 'เลขที่ใบกำกับภาษี',
            'value' => '$data->tax->taxNumber',
        ),
        array(
            'name' => 'ราคารวม',
            'value' => '$data->tax->totalPrice',
        ),
        array(
            'class' => 'bootstrap.widgets.TbButtonColumn',
            'htmlOptions' => array('width' => '80px'),
            'template' => '{delete}',
            'buttons' => array(
                'delete' => array(
                    'url' => 'Yii::app()->createUrl("/relateinvoicetax/delete", array("id" => $data->relate_invoice_taxId))',
                ),
            ),
        ),
    ),
));
?>

<br>
<h1>แสดงตัวอย่างใบกำกับภาษี</h1>
<div style="text-align: center;margin-bottom: 10px;">
    <a href="<?= Yii::app()->createUrl("/invoice/pdf", array("id" => $model->invoiceId)); ?>" target="_blank"><button class="btn btn-success">Print</button></a>
</div>
<div style="width:800px;text-align:center;margin: 0 auto;margin-bottom:20px;border-style: solid;
     border-width: 1px;border-color:black;padding:20px;height:1100px">
    <table cellspacing="0" cellpadding="0" border="0" width="100%">
        <tr>
            <td style="width:120px"></td>
            <td style="text-align:center;">
                <b style="font-size:16">รุ่งปิติพร การทอ (สำนักงานใหญ่)</b><br>
                149.151 ซอยเพชรเกษม 42 แยก 1 แขวงบางจาก เขตภาษีเจริญ<br>
                กรุงเทพมหานคร โทร. 0-2869-5155 แฟ็กซ์ 0-2869-8042<br>
                เลขประจำตัวผู้เสียภาษีอากร 3140600008006<br><br>
            </td>
            <td style="vertical-align:top;text-align:middle;"><b>เลขที่: <?= $model->invoiceNumber; ?></b></td>
        </tr>
        <tr style="font-size:16;">
            <td></td>
            <td><b>ใบเสร็จรับเงิน</b></td>
            <td></td>
        </tr>
    </table><br>
    <table width="100%" >
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
                        <td style="text-align:left;"><b>วันที่: </b>&nbsp&nbsp  <?= DateManager::convertThaiYear($model->dateCreate); ?></td>
                    </tr>
                    <tr>
                        <td style="text-align:left;"><b> </b> </td>
                    </tr>
                    <tr>
                        <td style="text-align:left;"><b> </b></td>
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
        $models = $relateInvoiceTaxData->getData();
        $total = 0;

        $count =  count($models);

        if($count <= 12)
            $count = 12;


        for ($i = 0; $i < $count; $i++) {
            ?>

            <tr style="height:35px;font-weight:bold;">
                <td width="50px" style="text-align:center;padding:5px;border-right: 1px solid black;border-left: 1px solid black;"><? if (isset($models[$i])) echo $i + 1; ?></td>
                <td width="300px" style="text-align:left;padding:5px;border-right: 1px solid black;"> <? if (isset($models[$i])) echo "ใบกำกับภาษีเลขที่ " . $models[$i]->tax->taxNumber; ?></td>

                <td width="120px" style="text-align:center;padding:5px;border-right: 1px solid black;"><? if (isset($models[$i])) echo ""; ?></td>
                <td width="100px" style="text-align:right;padding:5px;border-right: 1px solid black;" style="text-align:center;"><? if (isset($models[$i])) echo ""; ?></td>
                <td width="20px" style="text-align:right;padding:5px;border-right: 1px solid black;" style="text-align:center;"><? if (isset($models[$i])) echo ""; ?></td>
                <td width="80px" style="text-align:right;padding:5px;border-left: 1px solid black;border-right: 1px solid black;"><? if (isset($models[$i])) echo substr(number_format($models[$i]->tax->totalPrice, 2, ".", ","), 0, -3); ?></td>
                <td width="20px" style="text-align:right;padding:5px;border-right: 1px solid black;"><?
                    if (isset($models[$i])) {
                        if (substr(number_format($models[$i]->tax->totalPrice, 2, ".", ","), -2) == 00)
                            echo "-";
                        else
                            echo substr(number_format($models[$i]->tax->totalPrice, 2, ".", ","), -2);
                    }
                    ?></td>

            </tr>

            <?
            if (isset($models[$i]))
                $total += $models[$i]->tax->totalPrice;
        }
        ?>


        <? $texttotal = '(' . CurrencyManager::ThaiBahtConversion(str_replace(",", "", ($total * 7 / 100) + $total)) . ')'; ?>
    </table>
    <table width="100%" style="font-weight:bold;">
        <tr nobr="true">
            <td width="336px" style="text-align:center;border-top: 1px solid black;"> <br><br><b>จำนวนเงินรวมทั้งสิ้น (ตัวอักษร)</b> <br><table style="width:95%;" border="1"><tr><td style="text-align:center;"><?= $texttotal ?></td></tr></table></td>
            <td  width="237px" style="text-align:right;padding:5px;border-left: 1px solid black;border-bottom: 1px solid black;border-top: 1px solid black;"><b> 
                    รวมราคาสินค้าทั้งสิ้น<br> 
                    จำนวนภาษีมูลค่าเพิ่ม 7%<br> 
                    รวมเป็นเงินทั้งสิ้น
                </b></td>
            <td style="text-align:right;border-left: 1px solid black;border-bottom: 1px solid black;border-top: 1px solid black;" width="80px"> <?= substr(number_format($total, 2, ".", ","), 0, -3); ?><br>
                <?= substr(number_format($total * 7 / 100, 2, ".", ","), 0, -3); ?><br>
                <?= substr(number_format(($total * 7 / 100) + $total, 2, ".", ","), 0, -3); ?>
            </td>
            <td width="17px" style="text-align:right;padding:5px;border-left: 1px solid black;border-right: 1px solid black;border-top: 1px solid black;border-bottom: 1px solid black;" > 
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
    <table>
        <tr>
            <td style="width:100px">ชำระโดย </td><td style="text-align:left;"> <img src="images/checkbox.png" width="15px" /> เงินสด</td>
        </tr>
        <tr>
            <td></td><td style="text-align:left;"> <img src="images/checkbox.png" width="15px"/> เช็ค เลขที่.............................. ธนาคาร.............................. สาขา........................ ลงวันที่.....................</td>
        </tr>
    </table><br>
    <table cellspacing="0" cellpadding="1" border="1" style="text-align:center;font-weight:bold;" nobr="true" width="100%"> 
        <tr>
            <td style="width:250px"><br><br><br>
                .............................................................<br><br>
                ผู้รับเงิน

                <br>
                        
            </td>
            <td style="width:250px"><br><br><br>
                .............................................................<br><br>
                ผู้อนุมัติ      
                <br>
                     
            </td>
        </tr>

    </table>
    <br>
    <table  width="100%">
        <tr>
            <td style="text-align:center;font-weight:bold;">กรณีชำระเงินด้วยเช็ค ใบเสร็จรับเงินฉบับนี้จะสมบูรณ์ต่อเมื่อขึ้นเงินตามเช็คแล้ว</td>
        </tr>
    </table>
</div>