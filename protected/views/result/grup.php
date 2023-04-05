<section class="content-header">
	<div class="btn-group">

	</div>

	<ol class="breadcrumb">
		<li><a href="<?= Yii::app()->createUrl("dashboard") ?>"><i class="fa fa-dashboard"></i> Dashboard </a></li>
		<li>Result</li>
	</ol>
</section>

<section class="content">
	<div class="box box-info">
		<div class="box-header with-border">
			<h3 class="box-title">Result</h3>

			<div class="box-tools pull-right">
				<button type="button" class="btn btn-box-tool" id="btn-refresh" data-toggle="tooltip" title="Refresh"><i class="fa fa-refresh"></i></button>
			</div>
		</div>

		<div class="box-body">
			<ul class="nav nav-tabs">
				<li role="presentation" class="active"><a href="index.php?r=result/grup">Grup </a></li>
				<li role="presentation" class=""><a href="index.php?r=result">Detail</a></li>
			</ul>

			<div class="table-responsive">
				<?php $this->widget('booster.widgets.TbGridView', array(
					'id' => 'result-grid',
					'type' => 'condensed hover',
					'dataProvider' => $model->search(),
					'filter' => $model,
					'columns' => array(
						'KodePatient',
						array(
							'name' => 'KodeAlat',
							'filter' => VResult::alat(),
						),
						'tgl',
						array(
							'class' => 'booster.widgets.TbButtonColumn',
							'template' => '{view}',
							'buttons' => array(
								'view' =>
								array(
									'label' => 'Detail',
									'icon' => 'glyphicon glyphicon-eye-open',
									'url' => 'Yii::app()->createUrl("result/detail", array("alat" => $data->KodeAlat, "sampel" => $data->KodePatient,  "tgl" => $data->tgl, "tanggal" => $data->tanggal))',
									'options' => array(
										'onclick' => '$("#modal-pemeriksaan").modal("show");',
										'ajax' => array(
											'type' => 'POST',
											'url' => "js:$(this).attr('href')",
											'update' => '.modal-body',
										),
									),
								),
							),
						),
					),
				)); ?>
			</div>
		</div>
</section>

<div class="modal fade" id="modal-pemeriksaan">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Detail Pemeriksaan Alat</h4>
			</div>

			<div class="modal-body">
				
			</div>
		</div>
	</div>
</div>


<!-- <div class="modal fade" id="MyModal" tabindex="-1" role="dialog">
	<div class="modal-dialog modal-full">
		<div class="modal-content">

		</div>
	</div>
</div> -->

<script type="text/javascript">
	$(document).ready(function() {
		$("#btn-refresh").on("click", function(e) {
			$.fn.yiiGridView.update('result-grid', {
				data: $(this).serialize()
			});
		});
	});
</script>