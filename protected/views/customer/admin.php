<h1>จัดการข้อมูลลูกค้า</h1>

<?php
$this->widget('bootstrap.widgets.TbGridView', array(
    'id' => 'customer-grid',
    'dataProvider' => $model->search(),
    'filter' => $model,
    'columns' => array(
        'name',
        'address',
        'vatId',
        array(
            'class' => 'bootstrap.widgets.TbButtonColumn',
            'template' => '{update} {delete}'
        ),
    ),
));
?>
