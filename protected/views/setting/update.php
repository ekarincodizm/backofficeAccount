<?php
$this->breadcrumbs=array(
	'Settings'=>array('index'),
	$model->settingName=>array('view','id'=>$model->settingName),
	'Update',
);

$this->menu=array(
	array('label'=>'List Setting','url'=>array('index')),
	array('label'=>'Create Setting','url'=>array('create')),
	array('label'=>'View Setting','url'=>array('view','id'=>$model->settingName)),
	array('label'=>'Manage Setting','url'=>array('admin')),
);
?>

<h1>Update Setting <?php echo $model->settingName; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>