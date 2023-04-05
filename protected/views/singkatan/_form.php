<?php $form=$this->beginWidget('booster.widgets.TbActiveForm',array(
	'id'=>'singkatan-form',
	'enableAjaxValidation'=>false,
)); ?>


	<?php echo $form->textFieldGroup($model,'singkat',array('widgetOptions'=>array('htmlOptions'=>array('class'=>'col-md-12 col-xs-12','maxlength'=>10, 'style'=>'margin-bottom:10px;')))); ?>

	<?php echo $form->textFieldGroup($model,'kepanjangan',array('widgetOptions'=>array('htmlOptions'=>array('class'=>'col-md-12 col-xs-12','maxlength'=>50, 'style'=>'margin-bottom:10px;')))); ?>

	<?php echo $form->textFieldGroup($model,'identik',array('widgetOptions'=>array('htmlOptions'=>array('class'=>'col-md-12 col-xs-12','maxlength'=>50, 'style'=>'margin-bottom:10px;')))); ?>

	<?php $this->widget('booster.widgets.TbButton', array(
		'buttonType'=>'submit',
		'context'=>'primary',
		'label'=>$model->isNewRecord ? 'Create' : 'Save',
	)); ?>

<?php $this->endWidget(); ?>

<script type="text/javascript">
$(document).ready(function(){
	$("#btn-refresh").on("click",function(e){
		document.getElementById("singkatan-form").reset();
	});
});
</script>