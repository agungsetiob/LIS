<?php $form=$this->beginWidget('booster.widgets.TbActiveForm',array(
	'id'=>'pasien-form',
	'enableAjaxValidation'=>false,
)); ?>

	<?php echo $form->textFieldGroup($model,'no_rm',array('widgetOptions'=>array('htmlOptions'=>array('class'=>'col-md-12 col-xs-12','maxlength'=>50, 'style'=>'margin-bottom:10px;', 'id'=>'no_rm_cek')))); ?>

	<?php echo $form->textFieldGroup($model,'nama',array('widgetOptions'=>array('htmlOptions'=>array('class'=>'col-md-12 col-xs-12','maxlength'=>100, 'style'=>'margin-bottom:10px;')))); ?>

	<?php echo $form->textFieldGroup($model,'tempat_lahir',array('widgetOptions'=>array('htmlOptions'=>array('class'=>'col-md-12 col-xs-12','maxlength'=>100, 'style'=>'margin-bottom:10px;')))); ?>

	<?php echo $form->datePickerGroup($model,'tgl_lahir',array('widgetOptions'=>array('options'=>array('format' => 'dd-mm-yyyy','autoclose'=>'true'),'htmlOptions'=>array('class'=>'col-md-12 col-xs-12','placeholder'=>'dd-mm-yyyy')), 'prepend'=>'<i class="glyphicon glyphicon-calendar"></i>')); ?>

	<?php echo $form->dropDownListGroup($model,'gender',array(
		'widgetOptions' => array(
			'data' => Parameter::items("cSex"),
			'htmlOptions' => array('class'=>'col-md-12 col-xs-12','style'=>'margin-bottom:10px;'),
		)
	)); ?>

	<?php echo $form->textFieldGroup($model,'alamat',array('widgetOptions'=>array('htmlOptions'=>array('class'=>'col-md-12 col-xs-12','maxlength'=>200, 'style'=>'margin-bottom:10px;')))); ?>

	<?php $this->widget('booster.widgets.TbButton', array(
		'buttonType'=>'button',
		'context'=>'primary',
		'label'=>'Simpan',
		'htmlOptions' => array('id'=>'simpan-pasien'),
	)); ?>

<?php $this->endWidget(); ?>

<script type="text/javascript">
$(document).ready(function(){
	$('#simpan-pasien').click(function(){
		$.ajax({
			type: 'POST',
			url: '<?php echo Yii::app()->createUrl("pasien/simpan"); ?>',
			data: $('#pasien-form').serialize(),
			dataType: 'json',
			success: function(data) {
				if(data.status=="sukses"){
					document.getElementById("pasien-form").reset();
					$.fn.yiiGridView.update('pasien-grid',{
						data: $(this).serialize()
					});
					$('#Periksa_id_pasien').val(data.id);
					$('#Periksa_nama_pasien').val(data.nama);
					$('#modal-pasien').modal('hide');
				} else if(data.status=="ada"){
					document.getElementById("pasien-form").reset();
					$.fn.yiiGridView.update('pasien-grid',{
						data: $(this).serialize()
					});
					$('#Periksa_id_pasien').val(data.id);
					$('#Periksa_nama_pasien').val(data.nama);
					$('#modal-pasien').modal('hide');
				}
				else {
					alert("gagal");
				}
			}
		})
	});

	$("#Pasien_state").change(function(){
		var state = $(this).val();
		if(state=='2'){
			$("#no_bpjs").show();
		} else if(state=='3'){
			$("#no_bpjs").hide();
			$("#id_instansi").show();
		} else {
			$("#no_bpjs").hide();			
			$("#id_instansi").hide();
			$("#Pasien_no_bpjs").val('');
			$("#Pasien_id_instansi").val('0');
		}
	});
	

	$("#no_rm_cek").change(function(){
		$.ajax({
			type: 'POST',
			url: '<?php echo Yii::app()->createUrl("pasien/simpan"); ?>',
			data: $('#pasien-form').serialize(),
			dataType: 'json',
			success: function(data) {
				if(data.status=="ada"){
					document.getElementById("pasien-form").reset();
					$.fn.yiiGridView.update('pasien-grid',{
						data: $(this).serialize()
					});
					$('#Periksa_id_pasien').val(data.id);
					$('#Periksa_nama_pasien').val(data.nama);
					$('#modal-pasien').modal('hide');
				}
			}
		})
	});
});
</script>