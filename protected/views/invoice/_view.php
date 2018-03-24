<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('invoiceId')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->invoiceId),array('view','id'=>$data->invoiceId)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('customerId')); ?>:</b>
	<?php echo CHtml::encode($data->customerId); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('dateCreate')); ?>:</b>
	<?php echo CHtml::encode($data->dateCreate); ?>
	<br />


</div>