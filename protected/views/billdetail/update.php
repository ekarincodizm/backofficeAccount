<?php
$this->breadcrumbs=array(
	'Billdetails'=>array('index'),
	$model->billDetailId=>array('view','id'=>$model->billDetailId),
	'Update',
);

$this->menu=array(
	array('label'=>'List Billdetail','url'=>array('index')),
	array('label'=>'Create Billdetail','url'=>array('create')),
	array('label'=>'View Billdetail','url'=>array('view','id'=>$model->billDetailId)),
	array('label'=>'Manage Billdetail','url'=>array('admin')),
);
?>

<h1>Update Billdetail <?php echo $model->billDetailId; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>