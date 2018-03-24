<?php
$this->breadcrumbs=array(
	'Products'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Product','url'=>array('index')),
	array('label'=>'Manage Product','url'=>array('admin')),
);
?>

<h1>สร้างข้อมูลสินค้า</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>