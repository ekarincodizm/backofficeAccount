<h1>จัดการข้อมูลสินค้า</h1>

<?php
$this->widget('bootstrap.widgets.TbGridView', array(
    'id' => 'product-grid',
    'dataProvider' => $model->search(),
    'filter' => $model,
    'columns' => array(
        'name',
        'price',
        array(
            'class' => 'bootstrap.widgets.TbButtonColumn',
            'template' => '{update} {delete}'
        ),
    ),
));
?>
