<div class="table-responsive">
	<?php $this->widget('booster.widgets.TbGridView',array(
		'id'=>'kode-grid',
		'type'=>'condensed bordered hover',
		'dataProvider'=>$model->search(),
		'filter'=>$model,
		'columns'=>array(
			'nama',
			'lis',
			'grup1',
			'grup2',
			'grup3',
			array(
				'type'=>'raw',
				'value'=>'CHtml::Button("+",
					array("onClick" => "
						$(\"#LaporanGrup_kode\").val(\"$data->id\");
						$(\"#LaporanGrup_nama\").val(\"$data->nama\");
						$(\"#LaporanGrup_grup1\").val(\"$data->grup1\");
						$(\"#LaporanGrup_grup2\").val(\"$data->grup2\");
						$(\"#LaporanGrup_grup3\").val(\"$data->grup3\");
					")
				)'
				,'htmlOptions'=>array('data-dismiss'=>'modal','class'=>'text-center')
			),
		),
	)); ?>
</div>