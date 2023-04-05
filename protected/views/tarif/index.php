<section class="content-header">
	<div class="btn-group">
		<button type="button" class="btn btn-info btn-sm"><i class="fa fa-plus"></i></button>
		<a class="btn btn-bitbucket btn-sm" href="<?= Yii::app()->createUrl("tarif/create") ?>">Tambah Tarif</a>
	</div>

	<ol class="breadcrumb">
		<li><a href="<?= Yii::app()->createUrl("dashboard") ?>"><i class="fa fa-dashboard"></i> Dashboard </a></li>
		<li>Tarif</li>
	</ol>
</section>

<section class="content">
	<div class="box box-info">
		<div class="box-header with-border">
			<h3 class="box-title">Tarif</h3>

			<div class="box-tools pull-right">
				<button type="button" class="btn btn-box-tool" id="btn-refresh" data-toggle="tooltip" title="Refresh"><i class="fa fa-refresh"></i></button>
			</div>
		</div>

		<div class="box-body">
			<div class="table-responsive">
				<?php $this->widget('booster.widgets.TbGridView', array(
					'id' => 'tarif-grid',
					'type' => 'condensed hover',
					'dataProvider' => $model->search(),
					'filter' => $model,
					'columns' => array(
						'pemeriksaan',
						array(
							'name' => 'tarif',
							'value' => 'Yii::app()->indoFormat->number($data->tarif)',
							'filter' => ''
						),
						array(
							'class' => 'booster.widgets.TbButtonColumn',
							'template' => '{update}{delete}'
						),
					),
				)); ?>
			</div>
		</div>
	</div>
</section>