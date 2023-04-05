<section class="content-header">
	<div class="btn-group">
		<button type="button" class="btn btn-info btn-sm"><i class="fa fa-chevron-left"></i></button>
		<a class="btn btn-bitbucket btn-sm" href="<?= Yii::app()->createUrl("db") ?>">Kembali</a>
	</div>
	  
	<ol class="breadcrumb">
		<li><a href="<?= Yii::app()->createUrl("dashboard") ?>"><i class="fa fa-dashboard"></i> Dashboard </a></li>
		<li><a href="<?= Yii::app()->createUrl("db") ?>"> Database </a></li>
		<li>Add</li>
	</ol>
</section>

<section class="content">
    <div class="box box-info">
		<div class="box-header with-border">
			<h3 class="box-title">Upload Database</h3>

			<div class="box-tools pull-right">
				<button type="button" class="btn btn-box-tool" id="btn-refresh" data-toggle="tooltip" title="Refresh"><i class="fa fa-refresh"></i></button>
			</div>
		</div>

		<div class="box-body">
			<?php $form=$this->beginWidget('booster.widgets.TbActiveForm',array(
				'id'=>'upload-form',
				'enableAjaxValidation'=>false,
				'htmlOptions'=>array('enctype'=>'multipart/form-data'),
			)); ?>

			<?php echo $form->fileFieldGroup($model, 'file'); ?>	

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
		document.getElementById("upload-form").reset();
	});
});
</script>