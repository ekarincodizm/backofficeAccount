<?php
$this->breadcrumbs=array(
	'Relate Tax Products'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List RelateTaxProduct','url'=>array('index')),
	array('label'=>'Manage RelateTaxProduct','url'=>array('admin')),
);
?>

<h1>Create RelateTaxProduct</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>