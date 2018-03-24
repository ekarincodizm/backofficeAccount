<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('customerId')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->customerId),array('view','id'=>$data->customerId)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('name')); ?>:</b>
	<?php echo CHtml::encode($data->name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('address')); ?>:</b>
	<?php echo CHtml::encode($data->address); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('vatId')); ?>:</b>
	<?php echo CHtml::encode($data->vatId); ?>
	<br />


</div>