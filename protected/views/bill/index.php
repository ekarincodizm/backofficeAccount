<?php
$this->breadcrumbs=array(
	'Bills',
);

$this->menu=array(
	array('label'=>'Create Bill','url'=>array('create')),
	array('label'=>'Manage Bill','url'=>array('admin')),
);
?>

<h1>Bills</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
