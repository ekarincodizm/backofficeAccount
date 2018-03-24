<?php
$this->breadcrumbs=array(
	'Relate Invoice Taxes',
);

$this->menu=array(
	array('label'=>'Create RelateInvoiceTax','url'=>array('create')),
	array('label'=>'Manage RelateInvoiceTax','url'=>array('admin')),
);
?>

<h1>Relate Invoice Taxes</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
