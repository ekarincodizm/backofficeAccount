<?php
$this->breadcrumbs=array(
	'Relate Tax Products'=>array('index'),
	$model->relate_tax_productId=>array('view','id'=>$model->relate_tax_productId),
	'Update',
);

$this->menu=array(
	array('label'=>'List RelateTaxProduct','url'=>array('index')),
	array('label'=>'Create RelateTaxProduct','url'=>array('create')),
	array('label'=>'View RelateTaxProduct','url'=>array('view','id'=>$model->relate_tax_productId)),
	array('label'=>'Manage RelateTaxProduct','url'=>array('admin')),
);
?>

<h1>Update RelateTaxProduct <?php echo $model->relate_tax_productId; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>