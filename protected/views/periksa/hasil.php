<section class="content-header">
	<div class="btn-group">
	</div>

	<ol class="breadcrumb">
		<li><a href="<?= Yii::app()->createUrl("dashboard") ?>"><i class="fa fa-dashboard"></i> Dashboard </a></li>
		<li>Hasil</li>
	</ol>
</section>

<section class="content">
	<div class="box box-info">
		<div class="box-header with-border">
			<h3 class="box-title">Hasil Pemeriksaan</h3>

			<div class="box-tools pull-right">
				<button type="button" class="btn btn-box-tool" id="btn-refresh" data-toggle="tooltip" title="Refresh"><i class="fa fa-refresh"></i></button>
			</div>
		</div>

		<div class="box-body">
			<div class="table-responsive">
				<?php $this->widget('booster.widgets.TbGridView',array(
					'id'=>'periksa-grid',
					'type'=>'condensed bordered striped hover',
					'dataProvider'=>$model->searchHasil(),
					'filter'=>$model,
					'rowCssClassExpression'=>'($data->kritis==1)?"danger":" "',
					'columns'=>array(
						'nomor',
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
							'name' => 'id_ruang',
							'value'=>'$data->idRuang->nama',
						),
						array(
							'name' => 'validasi',
							'value'=>'Parameter::getStatusValidasi($data->validasi)',
							'filter'=>Parameter::items("cValidasi"),
							'htmlOptions'=>array('class'=>'text-center'),
							'type'=>'raw'
						),
						array(
							'name' => 'kritis',
							'value'=>'Parameter::getStatusKritis($data->kritis)',
							'filter'=>Parameter::items("cValidasi"),
							'htmlOptions'=>array('class'=>'text-center'),
							'type'=>'raw'
						),
						array(
							'name' => 'cetak',
							'value'=>'Parameter::getStatusCetak($data->cetak)',
							'filter'=>Parameter::items("cValidasi"),
							'htmlOptions'=>array('class'=>'text-center'),
							'type'=>'raw'
						),
						array(
							'class'=>'booster.widgets.TbButtonColumn',
							'template'=>'{view}{print}',
							'buttons'=>array
							(
								'view' => array
								(
									'visible'=>'Yii::app()->user->checkAccess("Periksa.View") OR Yii::app()->user->checkAccess("Periksa.*")',
								),
								'print' => array
								(
									'visible'=>'(Yii::app()->user->checkAccess("Periksa.Cetak") OR Yii::app()->user->checkAccess("Periksa.*")) AND $data->validasi==1',
									'label'=>'Print',
									'icon'=>'fa fa-print',
									'url'=>'Yii::app()->createUrl("periksa/cetak", array("id"=>$data->id))',
									'options'=>array(
										'target'=>'_blank',
									),
								),
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
								/*'print' => array
								(
									'label'=>'Print',
									'icon'=>'fa fa-print',
									'url'=>'Yii::app()->createUrl("periksa/vcetak", array("id"=>$data->id))',
									'options'=>array(
										// 'target'=>'_blank',
										'onclick'=>'$("#modal-cetak").modal("show");',
										'ajax'=>array(
											'type' => 'POST',
											'url' => "js:$(this).attr('href')",
											'update' => '.modal-body',
									   	),
									),
								),*/
							),
						),
					),
				)); ?>
			</div>
		</div>
	</div>
</section>

<script type="text/javascript">
$(document).ready(function(){
	$("#btn-refresh").on("click",function(e){
		$.fn.yiiGridView.update('periksa-grid',{
			data: $(this).serialize()
		});
	});
});
</script>