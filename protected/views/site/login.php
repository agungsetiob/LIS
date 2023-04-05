<script type="text/javascript">
  $(document).ready(function(){
    $("#LoginForm_username").focus();
  });
</script>

<?php $form=$this->beginWidget('booster.widgets.TbActiveForm',array(
	'id'=>'dokter-form',
	'enableAjaxValidation'=>false,
)); ?>

<?php echo $form->textFieldGroup($model, 'username', array('widgetOptions'=>array('htmlOptions'=>array('class'=>'col-md-12 col-xs-12', 'required'=>'required', 'style'=>'margin-bottom:10px;')))); ?>

<?php echo $form->passwordFieldGroup($model, 'password', array('widgetOptions'=>array('htmlOptions'=>array('class'=>'col-md-12 col-xs-12', 'required'=>'required', 'style'=>'margin-bottom:10px;')))); ?>

<?php $this->widget('booster.widgets.TbButton', array(
    'buttonType'=>'submit',
    'context'=>'primary',
    'label'=>'Login',
)); ?>

<?php $this->endWidget(); ?>