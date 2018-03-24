<?php
$this->breadcrumbs=array(
	'Billdetails'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Billdetail','url'=>array('index')),
	array('label'=>'Manage Billdetail','url'=>array('admin')),
);
?>

<h1>Create Billdetail</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>