<?php $form=$this->beginWidget('booster.widgets.TbActiveForm',array(
	'id'=>'kode-form',
	'enableAjaxValidation'=>false,
)); ?>

	<?php echo $form->textFieldGroup($model,'nama',array('widgetOptions'=>array('htmlOptions'=>array('class'=>'col-md-12 col-xs-12','maxlength'=>100, 'style'=>'margin-bottom:10px;')))); ?>

	<?php echo $form->textFieldGroup($model,'lis',array('widgetOptions'=>array('htmlOptions'=>array('class'=>'col-md-12 col-xs-12','maxlength'=>50, 'style'=>'margin-bottom:10px;')))); ?>
	
	<?php echo $form->textFieldGroup($model,'satuan',array('widgetOptions'=>array('htmlOptions'=>array('class'=>'col-md-12 col-xs-12','maxlength'=>50, 'style'=>'margin-bottom:10px;')))); ?>
	
	<?php echo $form->textFieldGroup($model,'grup1',array('widgetOptions'=>array('htmlOptions'=>array('class'=>'col-md-12 col-xs-12','maxlength'=>50, 'style'=>'margin-bottom:10px;')))); ?>
	
	<?php echo $form->textFieldGroup($model,'grup2',array('widgetOptions'=>array('htmlOptions'=>array('class'=>'col-md-12 col-xs-12','maxlength'=>50, 'style'=>'margin-bottom:10px;')))); ?>
	
	<?php echo $form->textFieldGroup($model,'grup3',array('widgetOptions'=>array('htmlOptions'=>array('class'=>'col-md-12 col-xs-12','maxlength'=>50, 'style'=>'margin-bottom:10px;')))); ?>

	<!-- <?php echo $form->dropDownListGroup($model,'grup1',array(
		'widgetOptions' => array(
			'data' => Parameter::items2("cGrup"),
			'htmlOptions' => array('class'=>'col-md-12 col-xs-12 select2','style'=>'margin-bottom:10px;'),
		)
	)); ?>

	<?php echo $form->dropDownListGroup($model,'grup2',array(
		'widgetOptions' => array(
			'data' => Parameter::items2("cGrup2"),
			'htmlOptions' => array('class'=>'col-md-12 col-xs-12 select2','style'=>'margin-bottom:10px;'),
		)
	)); ?>

	<?php echo $form->dropDownListGroup($model,'grup3',array(
		'widgetOptions' => array(
			'data' => Parameter::items2("cGrup3"),
			'htmlOptions' => array('class'=>'col-md-12 col-xs-12 select2','style'=>'margin-bottom:10px;'),
		)
	)); ?> -->

	<?php echo $form->textFieldGroup($model,'metoda',array('widgetOptions'=>array('htmlOptions'=>array('class'=>'col-md-12 col-xs-12','maxlength'=>50, 'style'=>'margin-bottom:10px;')))); ?>

	<?php echo $form->dropDownListGroup($model,'parameter',array(
		'widgetOptions' => array(
			'data' => Parameter::items("cParameter"),
			'htmlOptions' => array('class'=>'col-md-12 col-xs-12 select2','style'=>'margin-bottom:10px;'),
		)
	)); ?>

	<?php echo $form->dropDownListGroup($model,'pembulatan',array(
		'widgetOptions' => array(
			'data' => Parameter::items("cPembulatan"),
			'htmlOptions' => array('class'=>'col-md-12 col-xs-12 select2','style'=>'margin-bottom:10px;'),
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
		document.getElementById("kode-form").reset();
	});
});
</script>