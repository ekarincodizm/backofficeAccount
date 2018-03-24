<?php
$this->breadcrumbs=array(
	'Relate Invoice Taxes'=>array('index'),
	$model->relate_invoice_taxId,
);

$this->menu=array(
	array('label'=>'List RelateInvoiceTax','url'=>array('index')),
	array('label'=>'Create RelateInvoiceTax','url'=>array('create')),
	array('label'=>'Update RelateInvoiceTax','url'=>array('update','id'=>$model->relate_invoice_taxId)),
	array('label'=>'Delete RelateInvoiceTax','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->relate_invoice_taxId),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage RelateInvoiceTax','url'=>array('admin')),
);
?>

<h1>View RelateInvoiceTax #<?php echo $model->relate_invoice_taxId; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'relate_invoice_taxId',
		'taxId',
		'invoiceId',
	),
)); ?>
