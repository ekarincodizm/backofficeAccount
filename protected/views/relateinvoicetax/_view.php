<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('relate_invoice_taxId')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->relate_invoice_taxId),array('view','id'=>$data->relate_invoice_taxId)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('taxId')); ?>:</b>
	<?php echo CHtml::encode($data->taxId); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('invoiceId')); ?>:</b>
	<?php echo CHtml::encode($data->invoiceId); ?>
	<br />


</div>