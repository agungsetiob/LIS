<?php $form=$this->beginWidget('booster.widgets.TbActiveForm',array(
	'id'=>'periksa-form',
	'enableAjaxValidation'=>false,
)); ?>

	<?php echo $form->hiddenField($model, 'id_pasien'); ?>

	<div class="row">
		<div class="col-md-6">
			<?php echo $form->textFieldGroup($model,'nomor',array('widgetOptions'=>array('htmlOptions'=>array('class'=>'col-md-12 col-xs-12','readonly'=>true, 'style'=>'margin-bottom:10px;')))); ?>
		</div>

		<div class="col-md-6">
			<?php echo $form->textFieldGroup($model,'tanggal',array('widgetOptions'=>array('htmlOptions'=>array('class'=>'col-md-12 col-xs-12','readonly'=>true, 'style'=>'margin-bottom:10px;')))); ?>
		</div>
	</div>

	<div class="row">
		<div class="col-md-6">
			<div class="form-group">
				<label class="control-label required">Pasien <span class="required">*</span></label>
				<div class="input-group">
					<span class="input-group-addon"><a href="" id="cari-pasien"><i class="fa fa-search"></i></a></span>
					<input class="form-control" readonly="readonly" name="Periksa[nama_pasien]" id="Periksa_nama_pasien" type="text">
				</div>
			</div>
		</div>

		<div class="col-md-6">
			<?php echo $form->dropDownListGroup($model,'id_dokter',array(
				'widgetOptions' => array(
					'data' => Dokter::items(),
					'htmlOptions' => array('class'=>'col-md-12 col-xs-12 select2','style'=>'margin-bottom:10px;'),
				)
			)); ?>
		</div>
	</div>

	<div class="row">
		<div class="col-md-6">
			<?php echo $form->dropDownListGroup($model,'id_dokter2',array(
				'widgetOptions' => array(
					'data' => Dokter::items2(),
					'htmlOptions' => array('class'=>'col-md-12 col-xs-12 select2','style'=>'margin-bottom:10px;'),
				)
			)); ?>
		</div>

		<div class="col-md-6">
			<?php echo $form->dropDownListGroup($model,'id_ruang',array(
				'widgetOptions' => array(
					'data' => Ruang::items(),
					'htmlOptions' => array('class'=>'col-md-12 col-xs-12 select2','style'=>'margin-bottom:10px;'),
				)
			)); ?>
		</div>
	</div>

	<div class="row">
		<div class="col-md-6">
			<?php echo $form->dropDownListGroup($model,'id_petugas',array(
				'widgetOptions' => array(
					'data' => Petugas::items(),
					'htmlOptions' => array('class'=>'col-md-12 col-xs-12 select2','style'=>'margin-bottom:10px;'),
				)
			)); ?>
		</div>

		<div class="col-md-6">
			<?php echo $form->dropDownListGroup($model,'id_penjamin',array(
				'widgetOptions' => array(
					'data' => Parameter::items("cPenjamin"),
					'htmlOptions' => array('class'=>'col-md-12 col-xs-12 select2','style'=>'margin-bottom:10px;'),
				)
			)); ?>
		</div>
	</div>

	<?php $this->widget('booster.widgets.TbButton', array(
		'buttonType'=>'submit',
		'context'=>'primary',
		'label'=>'Simpan',
	)); ?>

<?php $this->endWidget(); ?>
