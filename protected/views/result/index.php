<script type="text/javascript">
	$(document).ready(function() {
		$("input").addClass("form-control");
	});
</script>

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
				<li role="presentation" class=""><a href="index.php?r=result/grup">Grup </a></li>
				<li role="presentation" class="active"><a href="index.php?r=result">Detail</a></li>
			</ul>

			<div class="table-responsive">
				<?php $this->widget('booster.widgets.TbGridView', array(
					'id' => 'result-grid',
					'type' => 'condensed hover',
					'dataProvider' => $model->search(),
					'filter' => $model,
					'afterAjaxUpdate' => 'inputForm',
					'columns' => array(
						array(
							'class' => 'booster.widgets.TbEditableColumn',
							'name' => 'KodePatient',
							'editable' => array(
								'url' => $this->createUrl('result/editable'),
							),
						),
						array(
							'class' => 'booster.widgets.TbEditableColumn',
							'name' => 'KodeAlat',
							'editable' => array(
								'url' => $this->createUrl('result/editable'),
							),
						),
						array(
							'class' => 'booster.widgets.TbEditableColumn',
							'name' => 'KodeParamater',
							'editable' => array(
								'url' => $this->createUrl('result/editable'),
							),
						),
						array(
							'name' => 'Nilai',
							'filter' => ''
						),
						array(
							'name' => 'tanggal',
							'filter' => '',
							'value' => 'Result::getTanggal($data->tanggal)'
						),
					),
				));

				Yii::app()->clientScript->registerScript('input-form', "
			function inputForm() {
				$('input').addClass('form-control');
			}");

				?>
			</div>
		</div>
</section>

<script type="text/javascript">
	$(document).ready(function() {
		$("#btn-refresh").on("click", function(e) {
			$.fn.yiiGridView.update('result-grid', {
				data: $(this).serialize()
			});
		});
	});
</script>