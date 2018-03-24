<h1>จัดการข้อมูลเริ่มต้น</h1>

<?php
$this->widget('bootstrap.widgets.TbGridView', array(
    'id' => 'setting-grid',
    'dataProvider' => $model->search(),
    'filter' => $model,
    'columns' => array(
        'description',
        'value',
        array(
            'class' => 'bootstrap.widgets.TbButtonColumn',
            'template' => '{update}',
        ),
    ),
));
?>

<div>*ถ้าต้องการให้ เลขที่ เริ่มต้นที่ 0001 ใหม่ให้แก้ไขเลขเป็น 0000</div>
