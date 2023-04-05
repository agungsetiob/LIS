<div class="table-responsive">
	<?php $this->widget('booster.widgets.TbGridView',array(
		'id'=>'pasien-grid',
		'type'=>'condensed bordered hover',
		'dataProvider'=>$model->search(),
		'filter'=>$model,
		'columns'=>array(
			'no_rm',
			'nama',
			array(
				'name'=>'tgl_lahir',
				'filter'=>''
			),
			array(
				'name'=>'alamat',
				'filter'=>''
			),
			array(
				'type'=>'raw',
				'value'=>'CHtml::Button("+",
					array("onClick" => "
						$(\"#LaporanPasien_pasien\").val(\"$data->id\");
						$(\"#Periksa_id_pasien\").val(\"$data->id\");
						$(\"#Periksa_nama_pasien\").val(\"$data->nama\");
					")
				)'
				,'htmlOptions'=>array('data-dismiss'=>'modal','class'=>'text-center')
			),
		),
	)); ?>
</div>