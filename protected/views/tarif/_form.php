<?php $form = $this->beginWidget('booster.widgets.TbActiveForm', array(
	'id' => 'tarif-form',
	'enableAjaxValidation' => false,
)); ?>

<div class="row">
	<div class="col-md-6">
		<?php echo $form->textFieldGroup($model, 'pemeriksaan', array('widgetOptions' => array('htmlOptions' => array('class' => 'col-md-12 col-xs-12', 'maxlength' => 100)))); ?>
	</div>

	<div class="col-md-6">
		<?php echo $form->textFieldGroup($model, 'tarif', array('widgetOptions' => array('htmlOptions' => array('class' => 'col-md-12 col-xs-12')))); ?>
	</div>
</div>


<div class="row" style="margin-top: 10px;">
	<div class="col-md-6">
		<?php $this->widget('booster.widgets.TbButton', array(
			'buttonType' => 'submit',
			'context' => 'primary',
			'label' => $model->isNewRecord ? 'Create' : 'Save',
		)); ?>
	</div>
</div>

<?php $this->endWidget(); ?>