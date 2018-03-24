<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'bill-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="help-block">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<?php echo $form->textFieldRow($model,'companyName',array('class'=>'span5','maxlength'=>100)); ?>

	<label><?= $model->getAttributeLabel('dateCreate'); ?> <span class="required">*</span></label>
	<?php
	$this->widget('zii.widgets.jui.CJuiDatePicker', array(
	    'name' => 'Bill[dateCreate]',
	    'value' => $model->dateCreate,
	    // additional javascript options for the date picker plugin
	    'options' => array(
	        'showAnim' => 'fold',
	        'dateFormat' => 'yy-mm-dd'
	    ),
	    'htmlOptions' => array(
	        'style' => 'height:20px;',
	    ),
	));
	?>


	<?php // echo $form->textFieldRow($model,'billNumber',array('class'=>'span5','maxlength'=>4)); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Create' : 'Save',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
