<div class="table-responsive">
	<?php $this->widget('booster.widgets.TbGridView',array(
		'id'=>'periksa-grid',
		'type'=>'condensed bordered striped hover',
		'dataProvider'=>$model->searchPending(),
		'filter'=>$model,
		'columns'=>array(
			array(
				'name' => 'nomor',
				'value'=>'Result::getTotalResult($data->nomor)',
				// 'filter'=>Parameter::items("cValidasi"),
				// 'htmlOptions'=>array('class'=>'text-center'),
				'type'=>'raw'
			),
			array(								
				'name' => 'tanggal',
				'value'=>'date("d-m-Y", strtotime($data->tanggal))',
			),
			array(								
				'name' => 'no_rm',
				'value'=>'$data->idPasien->no_rm',
				'headerHtmlOptions'=>array('style'=>'color: #3c8dbc;'),
			),
			array(								
				'name' => 'id_pasien',
				'value'=>'$data->idPasien->nama',
			),
			array(								
				'name' => 'id_dokter',
				'value'=>'Dokter::item($data->id_dokter)',
			),
			array(
				'name' => 'id_dokter2',
				'value'=>'Dokter::item($data->id_dokter2)',
				'filter'=>Dokter::items2(),
			),
			array(
				'name' => 'id_petugas',
				'value'=>'$data->idPetugas->nama',
			),
			array(
				'name' => 'id_ruang',
				'value'=>'$data->idRuang->nama',
			),
			array(
				'class'=>'booster.widgets.TbButtonColumn',
				'template'=>'{view}{barcode}{delete}',
				'buttons'=>array
				(
					'barcode' => array
					(
						'visible'=>'Yii::app()->user->checkAccess("Periksa.Cetak") OR Yii::app()->user->checkAccess("Periksa.*")',
						'label'=>'Barcode',
						'icon'=>'fa fa-barcode',
						'url'=>'Yii::app()->createUrl("periksa/barcode", array("id"=>$data->id))',
						'options'=>array(
							'target'=>'_blank',
						),
					)
				),
			),
		),
	)); ?>
</div>
    