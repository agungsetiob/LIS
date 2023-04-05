<section class="content-header">
	<div class="btn-group">

	</div>
	  
	<ol class="breadcrumb">
		<li><a href="<?= Yii::app()->createUrl("dashboard") ?>"><i class="fa fa-dashboard"></i> Dashboard </a></li>
		<li>Laporan Pasien</li>
	</ol>
</section>


<section class="content">
    <div class="box box-info">
		<div class="box-header with-border">
			<h3 class="box-title">Laporan Pasien</h3>
			<div class="box-tools pull-right">
			</div>
		</div>

		<div class="box-body">
            <?= $this->renderPartial('tab') ?>

            <?php $form=$this->beginWidget('booster.widgets.TbActiveForm',array(
                'id'=>'laporan-form',
                'enableAjaxValidation'=>false,
                'htmlOptions'=>array(
                    'target'=>'_blank'
                )
            )); ?>

            <div class="row">
                <div class="col-md-6">
                    <?php echo $form->datePickerGroup($model,'awal',array('widgetOptions'=>array('options'=>array('format' => 'dd-mm-yyyy','autoclose'=>'true'),'htmlOptions'=>array('class'=>'col-md-12 col-xs-12')), 'prepend'=>'<i class="fa fa-calendar"></i>')); ?>
                </div>

                <div class="col-md-6">
                    <?php echo $form->datePickerGroup($model,'akhir',array('widgetOptions'=>array('options'=>array('format' => 'dd-mm-yyyy','autoclose'=>'true'),'htmlOptions'=>array('class'=>'col-md-12 col-xs-12')), 'prepend'=>'<i class="fa fa-calendar"></i>')); ?>
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