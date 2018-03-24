<?php
$this->breadcrumbs=array(
	'Billdetails'=>array('index'),
	$model->billDetailId,
);

$this->menu=array(
	array('label'=>'List Billdetail','url'=>array('index')),
	array('label'=>'Create Billdetail','url'=>array('create')),
	array('label'=>'Update Billdetail','url'=>array('update','id'=>$model->billDetailId)),
	array('label'=>'Delete Billdetail','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->billDetailId),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Billdetail','url'=>array('admin')),
);
?>

<h1>View Billdetail #<?php echo $model->billDetailId; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'billDetailId',
		'no',
		'date',
		'remark',
		'billId',
	),
)); ?>
