<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('billId')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->billId),array('view','id'=>$data->billId)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('no')); ?>:</b>
	<?php echo CHtml::encode($data->no); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('companyName')); ?>:</b>
	<?php echo CHtml::encode($data->companyName); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('dateCreate')); ?>:</b>
	<?php echo CHtml::encode($data->dateCreate); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('billNumber')); ?>:</b>
	<?php echo CHtml::encode($data->billNumber); ?>
	<br />


</div>