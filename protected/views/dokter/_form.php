<?php $form=$this->beginWidget('booster.widgets.TbActiveForm',array(
	'id'=>'dokter-form',
	'enableAjaxValidation'=>false,
)); ?>

	<?php echo $form->textFieldGroup($model,'nama',array('widgetOptions'=>array('htmlOptions'=>array('class'=>'col-md-12 col-xs-12','maxlength'=>50, 'style'=>'margin-bottom:10px;')))); ?>

	<?php echo $form->textFieldGroup($model,'nip',array('widgetOptions'=>array('htmlOptions'=>array('class'=>'col-md-12 col-xs-12','maxlength'=>25, 'style'=>'margin-bottom:10px;')))); ?>

	<?php echo $form->dropDownListGroup($model,'kode',array(
		'widgetOptions' => array(
			'data' => Parameter::items("cKodeDokter"),
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
		document.getElementById("dokter-form").reset();
	});
});
</script>