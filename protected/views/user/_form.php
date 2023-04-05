<?php $form=$this->beginWidget('booster.widgets.TbActiveForm',array(
	'id'=>'user-form',
	'enableAjaxValidation'=>false,
)); ?>

	<?php echo $form->hiddenField($model, 'password'); ?>

	<?php echo $form->textFieldGroup($model,'username',array('widgetOptions'=>array('htmlOptions'=>array('class'=>'col-md-12 col-xs-12','maxlength'=>32, 'style'=>'margin-bottom:10px;')))); ?>

	<?php echo $form->textFieldGroup($model,'nama',array('widgetOptions'=>array('htmlOptions'=>array('class'=>'col-md-12 col-xs-12','maxlength'=>50, 'style'=>'margin-bottom:10px;')))); ?>

	<?php echo $form->textFieldGroup($model,'unit',array('widgetOptions'=>array('htmlOptions'=>array('class'=>'col-md-12 col-xs-12','maxlength'=>50, 'style'=>'margin-bottom:10px;')))); ?>

	<?php echo $form->dropDownListGroup($model,'id_level',array(
		'widgetOptions' => array(
			'data' => Parameter::items("cLevel"),
			'htmlOptions' => array('class'=>'col-md-12 col-xs-12','style'=>'margin-bottom:10px;'),
		)
	)); ?>

	<?php echo $form->dropDownListGroup($model,'id_petugas',array(
		'widgetOptions' => array(
			'data' => Petugas::items0(),
			'htmlOptions' => array('class'=>'col-md-12 col-xs-12 select2','style'=>'margin-bottom:10px;'),
		)
	)); ?>

	<?php echo $form->dropDownListGroup($model,'id_aktif',array(
		'widgetOptions' => array(
			'data' => Parameter::items("cYaTidak"),
			'htmlOptions' => array('class'=>'col-md-12 col-xs-12','style'=>'margin-bottom:10px;'),
		)
	)); ?>

	<?php $this->widget('booster.widgets.TbButton', array(
		'buttonType'=>'submit',
		'context'=>'primary',
		'label'=>'Simpan',
	)); ?>

<?php $this->endWidget(); ?>

<script type="text/javascript">
$(document).ready(function(){
	$("#btn-refresh").on("click",function(e){
		document.getElementById("user-form").reset();
	});
});
</script>