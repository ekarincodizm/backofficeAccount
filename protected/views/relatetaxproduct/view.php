<?php
$this->breadcrumbs=array(
	'Relate Tax Products'=>array('index'),
	$model->relate_tax_productId,
);

$this->menu=array(
	array('label'=>'List RelateTaxProduct','url'=>array('index')),
	array('label'=>'Create RelateTaxProduct','url'=>array('create')),
	array('label'=>'Update RelateTaxProduct','url'=>array('update','id'=>$model->relate_tax_productId)),
	array('label'=>'Delete RelateTaxProduct','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->relate_tax_productId),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage RelateTaxProduct','url'=>array('admin')),
);
?>

<h1>View RelateTaxProduct #<?php echo $model->relate_tax_productId; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'relate_tax_productId',
		'amount',
		'taxId',
		'productId',
	),
)); ?>
