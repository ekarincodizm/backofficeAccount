<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('settingName')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->settingName),array('view','id'=>$data->settingName)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('value')); ?>:</b>
	<?php echo CHtml::encode($data->value); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('description')); ?>:</b>
	<?php echo CHtml::encode($data->description); ?>
	<br />


</div>