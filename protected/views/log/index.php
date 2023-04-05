<section class="content-header">
	<div class="btn-group">
	</div>

	<ol class="breadcrumb">
		<li><a href="<?= Yii::app()->createUrl("dashboard") ?>"><i class="fa fa-dashboard"></i> Dashboard </a></li>
		<li>Log</li>
	</ol>
</section>

<section class="content">
	<div class="box box-info">
		<div class="box-header with-border">
			<h3 class="box-title">Log</h3>

			<div class="box-tools pull-right">
				<button type="button" class="btn btn-box-tool" id="btn-refresh" data-toggle="tooltip" title="Refresh"><i class="fa fa-refresh"></i></button>
			</div>
		</div>

		<div class="box-body">
			<div class="table-responsive">
				<?php $this->widget('booster.widgets.TbGridView', array(
					'id' => 'log-grid',
					'type' => 'condensed hover',
					'dataProvider' => $model->search(),
					'filter' => $model,
					'columns' => array(
						array(
							'name' => 'id_user',
							'value' => '$data->idUser->nama',
						),
						'kode',
						'keterangan',
						array(
							'name' => 'tanggal',
							'value' => 'date("d-m-Y H:i:s", strtotime($data->tanggal))',
							'filter' => '',
						),
						array(
							'name' => 'ip',
							'filter' => '',
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
			$('#log-grid').yiiGridView('update');
		});
	});
</script>