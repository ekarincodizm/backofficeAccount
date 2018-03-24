<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('taxId')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->taxId),array('view','id'=>$data->taxId)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('taxNumber')); ?>:</b>
	<?php echo CHtml::encode($data->taxNumber); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('customerId')); ?>:</b>
	<?php echo CHtml::encode($data->customerId); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('dateCreate')); ?>:</b>
	<?php echo CHtml::encode($data->dateCreate); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('totalPrice')); ?>:</b>
	<?php echo CHtml::encode($data->totalPrice); ?>
	<br />


</div>