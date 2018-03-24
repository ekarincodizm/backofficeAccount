<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('billDetailId')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->billDetailId),array('view','id'=>$data->billDetailId)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('no')); ?>:</b>
	<?php echo CHtml::encode($data->no); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('date')); ?>:</b>
	<?php echo CHtml::encode($data->date); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('remark')); ?>:</b>
	<?php echo CHtml::encode($data->remark); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('billId')); ?>:</b>
	<?php echo CHtml::encode($data->billId); ?>
	<br />


</div>