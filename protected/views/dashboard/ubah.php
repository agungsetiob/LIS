<section class="content-header">
	<div class="btn-group">
		
	</div>
	  
	<ol class="breadcrumb">
		<li><a href="<?= Yii::app()->createUrl("dashboard") ?>"><i class="fa fa-dashboard"></i> Dashboard </a></li>
		<li>Ubah Password</li>
	</ol>
</section>

<section class="content">
    <div class="box box-info">
		<div class="box-header with-border">
			<h3 class="box-title">Ubah Password</h3>

			<div class="box-tools pull-right">
				<button type="button" class="btn btn-box-tool" id="btn-refresh" data-toggle="tooltip" title="Refresh"><i class="fa fa-refresh"></i></button>
			</div>
		</div>

		<div class="box-body">
			<?php if(Yii::app()->user->hasFlash('info')): ?>
				<div class="alert alert-info alert-dismissible">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
					<h4><i class="icon fa fa-info"></i> Proses berhasil</h4>
              	</div>
			<?php endif; ?>

			<?php $form=$this->beginWidget('booster.widgets.TbActiveForm',array(
				'id'=>'rubah-password-form',
				'enableAjaxValidation'=>true,
				'clientOptions'=>array(
					'validateOnSubmit'=>true,
				),
			)); ?>

			<?php echo $form->hiddenField($model, 'id'); ?>

			<?php echo $form->textFieldGroup($model,'username',array('widgetOptions'=>array('htmlOptions'=>array('class'=>'col-md-12 col-xs-12','maxlength'=>50, 'style'=>'margin-bottom:10px;', 'readonly'=>true)))); ?>

			<?php echo $form->passwordFieldGroup($model,'password',array('widgetOptions'=>array('htmlOptions'=>array('class'=>'col-md-12 col-xs-12','maxlength'=>25, 'style'=>'margin-bottom:10px;')))); ?>

			<?php $this->widget('booster.widgets.TbButton', array(
				'buttonType'=>'submit',
				'context'=>'primary',
				'label'=>'Simpan',
			)); ?>

			<?php $this->endWidget(); ?>
		</div>
    </div>
</section>

<script type="text/javascript">
$(document).ready(function(){
	$("#btn-refresh").on("click",function(e){
		document.getElementById("rubah-password-form").reset();
	});
});
</script>