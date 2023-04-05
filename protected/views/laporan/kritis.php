<style>
	.modal-dialog {
		width: 100%;
		height: 100%;
		margin: 0;
		padding: 0;
	}

	.modal-content {
		min-height: 100%;
		border-radius: 0;
	}
</style>

<section class="content-header">
	<div class="btn-group">

	</div>

	<ol class="breadcrumb">
		<li><a href="<?= Yii::app()->createUrl("dashboard") ?>"><i class="fa fa-dashboard"></i> Dashboard </a></li>
		<li>Laporan Nilai Kritis</li>
	</ol>
</section>


<section class="content">
    <div class="box box-info">
		<div class="box-header with-border">
			<h3 class="box-title">Laporan Nilai Kritis</h3>
			<div class="box-tools pull-right">
			</div>
		</div>

		<div class="box-body">
            <?php $form=$this->beginWidget('booster.widgets.TbActiveForm',array(
                'id'=>'laporan-form',
                'enableAjaxValidation'=>false,
                'htmlOptions'=>array(
                    'target'=>'_blank'
                )
            )); ?>

            <?php echo $form->hiddenField($model, 'kode'); ?>

            <div class="row">
                <div class="col-md-6">
                    <?php echo $form->datePickerGroup($model,'awal',array('widgetOptions'=>array('options'=>array('format' => 'dd-mm-yyyy','autoclose'=>'true'),'htmlOptions'=>array('class'=>'col-md-12 col-xs-12')), 'prepend'=>'<i class="fa fa-calendar"></i>')); ?>
                </div>

                <div class="col-md-6">
                    <?php echo $form->datePickerGroup($model,'akhir',array('widgetOptions'=>array('options'=>array('format' => 'dd-mm-yyyy','autoclose'=>'true'),'htmlOptions'=>array('class'=>'col-md-12 col-xs-12')), 'prepend'=>'<i class="fa fa-calendar"></i>')); ?>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="control-label required">Kode Lab <span class="required">*</span></label>
                        <div class="input-group">
                            <span class="input-group-addon"><a href="" id="cari-kode"><i class="fa fa-search"></i></a></span>
                            <input class="form-control" readonly="readonly" id="Laporan_nama_kode" type="text">
                        </div>
                    </div>
                </div>
            </div>

            <?php $this->widget('booster.widgets.TbButton', array(
                'buttonType'=>'submit',
                'context'=>'danger',
                'label'=>'Cetak',
            )); ?>

            <?php $this->endWidget(); ?>
		</div>
    </div>
</section>

<div class="modal fade" id="modal-kode">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Kode Lab</h4>
			</div>

			<div class="modal-body">
				<?php $this->renderPartial("/kode/lookup", array("model"=>$kode)); ?>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
$(document).ready(function(){
	$('#cari-kode').click(function(e) {
		e.preventDefault();
		$.fn.yiiGridView.update('kode-grid',{
			data: $(this).serialize()
		});
		$('#modal-kode').modal('show');
	});
});
</script>