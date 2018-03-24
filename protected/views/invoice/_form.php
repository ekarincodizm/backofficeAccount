<?php
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id' => 'invoice-form',
    'enableAjaxValidation' => false,
        ));
?>

<p class="help-block">Fields with <span class="required">*</span> are required.</p>

<?php echo $form->errorSummary($model); ?>

<label><?= $model->getAttributeLabel('customerId'); ?></label>
<?php
echo CHtml::dropDownList('Invoice[customerId]', $model->customerId, CHtml::listData(Customer::model()->findAll(array('condition' => 'active = 1', 'order' => 'name asc')), 'customerId', 'name'), array('empty' => '-- กรุณาเลือกบริษัท --'), array('class' => 'span3'));
?>

<label><?= $model->getAttributeLabel('dateCreate'); ?></label>
<?php
$this->widget('zii.widgets.jui.CJuiDatePicker', array(
    'name' => 'Invoice[dateCreate]',
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

<div class="form-actions">
    <?php
    $this->widget('bootstrap.widgets.TbButton', array(
        'buttonType' => 'submit',
        'type' => 'primary',
        'label' => $model->isNewRecord ? 'Create' : 'Save',
    ));
    ?>
</div>

<?php $this->endWidget(); ?>
