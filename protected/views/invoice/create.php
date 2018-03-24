<?php
$this->breadcrumbs=array(
	'Invoices'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Invoice','url'=>array('index')),
	array('label'=>'Manage Invoice','url'=>array('admin')),
);
?>

<h1>สร้างใบเสร็จรับเงิน</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>