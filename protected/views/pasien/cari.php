<ul class="nav nav-tabs">
	<li class="active"><a data-toggle="tab" href="#data">Data</a></li>
	<li><a data-toggle="tab" href="#form">Form</a></li>
</ul>

<div class="tab-content">
	<div id="data" class="tab-pane fade in active">
		<br>
		<div class="table-responsive">
			<?php $this->widget('booster.widgets.TbGridView', array(
				'id' => 'pasien-grid',
				'type' => 'condensed bordered hover',
				'dataProvider' => $model->search(),
				'filter' => $model,
				'columns' => array(
					'no_rm',
					'nama',
					array(
						'name' => 'tgl_lahir',
						'filter' => ''
					),
					array(
						'name' => 'alamat',
						'filter' => ''
					),
					array(
						'type' => 'raw',
						'value' => 'CHtml::Button("+",
						array("onClick" => "
							$(\"#Periksa_id_pasien\").val(\"$data->id\");
							$(\"#Periksa_nama_pasien\").val(\"$data->nama\");
						")
					)', 'htmlOptions' => array('data-dismiss' => 'modal', 'class' => 'text-center')
					),
				),
			)); ?>
		</div>
	</div>
	<div id="form" class="tab-pane fade">
		<br>
		<?php $this->renderPartial("/pasien/_form2", array("model" => $model)); ?>
	</div>
	<div id="bridging" class="tab-pane fade">

	</div>
</div>

<script type="text/javascript">
$(document).ready(function(){
	$('#sinkron-pasien').submit(function(){
		var PasienID = $('#Pasien_no_rm').val();
		if(PasienID!=""){
			$.ajax({
				type: 'POST',
				url: '<?php echo Yii::app()->createUrl("pasien/sinkron"); ?>',
				data: { PasienID: PasienID },
				success: function(data) {
					if(data=="sukses"){
						alert("Proses berhasil");
					} else {
						$('#PasienID').focus().select();
						alert("ID Pasien tidak ditemukan");
					}
				}
			})
		} else {
			$('#PasienID').focus();
			alert("ID Pasien harus di isi");
		}

		$.fn.yiiGridView.update('pasien-grid', {
			data: $(this).serialize()
		});

		return false;
	});
});
</script>