<?php
$this->breadcrumbs=array(
	'Customers'=>array('index'),
	$model->name=>array('view','id'=>$model->customerId),
	'Update',
);

$this->menu=array(
	array('label'=>'List Customer','url'=>array('index')),
	array('label'=>'Create Customer','url'=>array('create')),
	array('label'=>'View Customer','url'=>array('view','id'=>$model->customerId)),
	array('label'=>'Manage Customer','url'=>array('admin')),
);
?>

<h1>แก้ไขข้อมูลลูกค้า <?php echo $model->name; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>