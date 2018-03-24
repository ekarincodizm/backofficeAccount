<?php
$this->breadcrumbs=array(
	'Billdetails',
);

$this->menu=array(
	array('label'=>'Create Billdetail','url'=>array('create')),
	array('label'=>'Manage Billdetail','url'=>array('admin')),
);
?>

<h1>Billdetails</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
