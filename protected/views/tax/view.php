<?php
$this->breadcrumbs=array(
	'Taxes'=>array('index'),
	$model->taxId,
);

$this->menu=array(
	array('label'=>'List Tax','url'=>array('index')),
	array('label'=>'Create Tax','url'=>array('create')),
	array('label'=>'Update Tax','url'=>array('update','id'=>$model->taxId)),
	array('label'=>'Delete Tax','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->taxId),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Tax','url'=>array('admin')),
);
?>

<h1>View Tax #<?php echo $model->taxId; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'taxId',
		'taxNumber',
		'customerId',
		'dateCreate',
		'totalPrice',
	),
)); ?>
