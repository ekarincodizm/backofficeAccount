<?php
$this->breadcrumbs=array(
	'Taxes',
);

$this->menu=array(
	array('label'=>'Create Tax','url'=>array('create')),
	array('label'=>'Manage Tax','url'=>array('admin')),
);
?>

<h1>Taxes</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
