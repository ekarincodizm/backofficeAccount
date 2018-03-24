<?php
$this->breadcrumbs=array(
	'Bills'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Bill','url'=>array('index')),
	array('label'=>'Manage Bill','url'=>array('admin')),
);
?>

<h1>สร้างใบวางบิล</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>