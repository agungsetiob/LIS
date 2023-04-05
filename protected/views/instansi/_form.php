<?php $form=$this->beginWidget('booster.widgets.TbActiveForm',array(
	'id'=>'instansi-form',
	'enableAjaxValidation'=>false,
)); ?>


	<?php echo $form->textFieldGroup($model,'nama',array('widgetOptions'=>array('htmlOptions'=>array('class'=>'col-md-12 col-xs-12','maxlength'=>100, 'style'=>'margin-bottom:10px;')))); ?>

	<?php echo $form->textFieldGroup($model,'alamat',array('widgetOptions'=>array('htmlOptions'=>array('class'=>'col-md-12 col-xs-12','maxlength'=>255, 'style'=>'margin-bottom:10px;')))); ?>

	<?php echo $form->textFieldGroup($model,'telepon',array('widgetOptions'=>array('htmlOptions'=>array('class'=>'col-md-12 col-xs-12','maxlength'=>30, 'style'=>'margin-bottom:10px;')))); ?>

	<?php $this->widget('booster.widgets.TbButton', array(
		'buttonType'=>'submit',
		'context'=>'primary',
		'label'=>'Simpan',
	)); ?>

<?php $this->endWidget(); ?>

<script type="text/javascript">
$(document).ready(function(){
	$("#btn-refresh").on("click",function(e){
		document.getElementById("instansi-form").reset();
	});
});
</script>