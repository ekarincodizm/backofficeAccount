<?php
$this->breadcrumbs=array(
	'Relate Tax Products',
);

$this->menu=array(
	array('label'=>'Create RelateTaxProduct','url'=>array('create')),
	array('label'=>'Manage RelateTaxProduct','url'=>array('admin')),
);
?>

<h1>Relate Tax Products</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
