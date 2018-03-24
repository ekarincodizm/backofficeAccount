<?php
$baseUrl = Yii::app()->baseUrl;
$cs = Yii::app()->getClientScript();
$cs->registerCoreScript('jquery');
$cs->registerScriptFile($baseUrl . '/js/jquery.mtz.monthpicker.js', CClientScript::POS_HEAD);
$cs->registerCssFile($baseUrl . '/css/jquery-ui.css');
?>

<h1>จัดการใบวางบิล</h1>

<form method="POST">
    เดือน <input type="text" id="customMonth" name="Bill[dateCreate]" value="<?php echo $model->dateCreate; ?>" />
    <input type="submit" class="btn btn-primary" value="ค้นหา" />
</form>
<script languague="javascript">
    options = {
        pattern: 'yyyy-mm', // Default is 'mm/yyyy' and separator char is not mandatory
        selectedYear: <?php echo date('Y') ?>,
        startYear: <?php echo date('Y', strtotime('last year')) ?>,
        finalYear: <?php echo date('Y') ?>,
        monthNames: ['01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12']
    };

    $('#customMonth').monthpicker(options);
</script>
<?php
$this->widget('bootstrap.widgets.TbGridView', array(
    'id' => 'bill-grid',
    'dataProvider' => $model->search(),
    'filter' => $model,
    'columns' => array(
        'billNumber',
        'companyName',
        array(
            'name' => 'dateCreate',
            'value' => 'DateManager::convertThaiYear("$data->dateCreate")',
        ),
        array(
            'class' => 'bootstrap.widgets.TbButtonColumn',
            'template' => '{update} {delete}'
        ),
    ),
));
?>
