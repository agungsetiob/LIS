<section class="content-header">
	<div class="btn-group">
	</div>

	<ol class="breadcrumb">
		<li><a href="<?= Yii::app()->createUrl("dashboard") ?>"><i class="fa fa-dashboard"></i> Dashboard </a></li>
		<li>Verifikasi</li>
	</ol>
</section>

<section class="content">
	<div class="box box-info">
		<div class="box-header with-border">
			<h3 class="box-title">Verifikasi Pemeriksaan</h3>

			<div class="box-tools pull-right">
				<button type="button" class="btn btn-box-tool" id="btn-refresh" data-toggle="tooltip" title="Refresh"><i class="fa fa-refresh"></i></button>
			</div>
		</div>

		<div class="box-body">
			<div class="table-responsive">
				<?php $this->widget('booster.widgets.TbGridView', array(
					'id' => 'periksa-grid',
					'type' => 'condensed bordered striped hover',
					'dataProvider' => $model->searchVerifikasi(),
					'filter' => $model,
					'columns' => array(
						'nomor',
						array(
							'name' => 'tanggal',
							'value' => 'date("d-m-Y", strtotime($data->tanggal))',
						),
						array(
							'name' => 'no_rm',
							'value' => '$data->idPasien->no_rm',
							'headerHtmlOptions' => array('style' => 'color: #3c8dbc;'),
						),
						array(
							'name' => 'id_pasien',
							'value' => '$data->idPasien->nama',
						),
						// array(
						// 	'name' => 'id_dokter',
						// 	'value' => '$data->idDokter->nama',
						// ),
						array(
							'name' => 'id_ruang',
							'value' => '$data->idRuang->nama',
						),
						array(
							'class' => 'booster.widgets.TbButtonColumn',
							'template' => '{view}',
							'buttons' => array(
								'view' => array(
									'visible' => 'Yii::app()->user->checkAccess("Periksa.View") OR Yii::app()->user->checkAccess("Periksa.*")',
								),
							),
						),
					),
				)); ?>
			</div>
		</div>
	</div>
</section>

<script type="text/javascript">
	$(document).ready(function() {
		$("#btn-refresh").on("click", function(e) {
			$.fn.yiiGridView.update('periksa-grid', {
				data: $(this).serialize()
			});
		});
	});
</script>