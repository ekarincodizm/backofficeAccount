<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('relate_tax_productId')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->relate_tax_productId),array('view','id'=>$data->relate_tax_productId)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('amount')); ?>:</b>
	<?php echo CHtml::encode($data->amount); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('taxId')); ?>:</b>
	<?php echo CHtml::encode($data->taxId); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('productId')); ?>:</b>
	<?php echo CHtml::encode($data->productId); ?>
	<br />


</div>