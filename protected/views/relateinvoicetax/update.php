<?php
$this->breadcrumbs=array(
	'Relate Invoice Taxes'=>array('index'),
	$model->relate_invoice_taxId=>array('view','id'=>$model->relate_invoice_taxId),
	'Update',
);

$this->menu=array(
	array('label'=>'List RelateInvoiceTax','url'=>array('index')),
	array('label'=>'Create RelateInvoiceTax','url'=>array('create')),
	array('label'=>'View RelateInvoiceTax','url'=>array('view','id'=>$model->relate_invoice_taxId)),
	array('label'=>'Manage RelateInvoiceTax','url'=>array('admin')),
);
?>

<h1>Update RelateInvoiceTax <?php echo $model->relate_invoice_taxId; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>