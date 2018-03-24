<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<?php echo $form->textFieldRow($model,'billId',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'companyName',array('class'=>'span5','maxlength'=>100)); ?>

	<?php echo $form->textFieldRow($model,'dateCreate',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'billNumber',array('class'=>'span5','maxlength'=>4)); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>'Search',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
