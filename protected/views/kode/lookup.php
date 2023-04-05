<div class="table-responsive">
	<?php $this->widget('booster.widgets.TbGridView',array(
		'id'=>'kode-grid',
		'type'=>'condensed bordered hover',
		'dataProvider'=>$model->search(),
		'filter'=>$model,
		'columns'=>array(
			'nama',
			'lis',
			'satuan',
			'grup1',
			array(
				'type'=>'raw',
				'value'=>'CHtml::Button("+",
					array("onClick" => "
						$(\"#LaporanKode_kode\").val(\"$data->id\");
						$(\"#Laporan_nama_kode\").val(\"$data->nama\");
						$(\"#Laporan_lis\").val(\"$data->lis\");
					")
				)'
				,'htmlOptions'=>array('data-dismiss'=>'modal','class'=>'text-center')
			),
		),
	)); ?>
</div>