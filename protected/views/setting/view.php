<?php
$this->breadcrumbs=array(
	'Settings'=>array('index'),
	$model->settingName,
);

$this->menu=array(
	array('label'=>'List Setting','url'=>array('index')),
	array('label'=>'Create Setting','url'=>array('create')),
	array('label'=>'Update Setting','url'=>array('update','id'=>$model->settingName)),
	array('label'=>'Delete Setting','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->settingName),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Setting','url'=>array('admin')),
);
?>

<h1>View Setting #<?php echo $model->settingName; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'settingName',
		'value',
		'description',
	),
)); ?>
