<section class="content-header">
	<div class="btn-group">

	</div>
	  
	<ol class="breadcrumb">
		<li><a href="<?= Yii::app()->createUrl("dashboard") ?>"><i class="fa fa-dashboard"></i> Dashboard </a></li>
		<li>Laporan Laba/Rugi</li>
	</ol>
</section>


<section class="content">
    <div class="box box-info">
		<div class="box-header with-border">
			<h3 class="box-title">Laporan Laba/Rugi</h3>
			<div class="box-tools pull-right">
			</div>
		</div>

		<div class="box-body">
          <?php $form=$this->beginWidget('booster.widgets.TbActiveForm',array(
          	'enableAjaxValidation'=>false,
            'htmlOptions'=>array('target'=>'_blank'),
          )); ?>

          <div class="row">
            <div class="col-md-6">
              <?php echo $form->dropDownListGroup($model,'bulan',array(
    					'widgetOptions' => array(
    						'data' => Parameter::items("cBulan"),
    						'htmlOptions' => array('class'=>'col-md-12 col-xs-12','style'=>'margin-bottom:10px;'),
    					)
    				)); ?>
            </div>

            <div class="col-md-6">
              <?php echo $form->textFieldGroup($model,'tahun',array('widgetOptions'=>array('htmlOptions'=>array('class'=>'col-md-12 col-xs-12','style'=>'margin-bottom:10px;','maxlength'=>4)))); ?>
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