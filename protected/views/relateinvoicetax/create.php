<?php
$this->breadcrumbs=array(
	'Relate Invoice Taxes'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List RelateInvoiceTax','url'=>array('index')),
	array('label'=>'Manage RelateInvoiceTax','url'=>array('admin')),
);
?>

<h1>Create RelateInvoiceTax</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>