<style>
	.modal-dialog {
		width: 100%;
		height: 100%;
		margin: 0;
		padding: 0;
	}

	.modal-content {
		min-height: 100%;
		border-radius: 0;
	}
</style>

<section class="content-header">
	<div class="btn-group">
		<button type="button" class="btn btn-info btn-sm"><i class="fa fa-chevron-left"></i></button>
		<a class="btn btn-bitbucket btn-sm" href="<?= Yii::app()->createUrl("periksa/biaya") ?>">Kembali</a>
	</div>

	<ol class="breadcrumb">
		<li><a href="<?= Yii::app()->createUrl("dashboard") ?>"><i class="fa fa-dashboard"></i> Dashboard </a></li>
		<li><a href="<?= Yii::app()->createUrl("periksa/biaya") ?>"> Biaya </a></li>
		<li>Detail</li>
	</ol>
</section>


<section class="content">
	<div class="box box-info">
		<div class="box-header with-border">
			<h3 class="box-title">Detail Biaya Pemeriksaan</h3>

			<div class="box-tools pull-right">
				<button type="button" class="btn btn-box-tool" id="btn-refresh" data-toggle="tooltip" title="Refresh"><i class="fa fa-refresh"></i></button>
			</div>
		</div>

		<div class="box-body">
			<div class="row">
				<div class="col-md-6">
					<div class="row">
						<div class="col-md-3">
							ID Pasien
						</div>
						<div class="col-md-9">
							: <?= $model->idPasien->no_rm ?>
						</div>
					</div>
				</div>

				<div class="col-md-6">
					<div class="row">
						<div class="col-md-3">
							No. LIS/No. LAB
						</div>
						<div class="col-md-9">
							: <?= $model->nomor ?>
						</div>
					</div>
				</div>
			</div>

			<div class="row">
				<div class="col-md-6">
					<div class="row">
						<div class="col-md-3">
							Nama
						</div>
						<div class="col-md-9">
							: <?= $model->idPasien->nama ?>
						</div>
					</div>
				</div>

				<div class="col-md-6">
					<div class="row">
						<div class="col-md-3">
							Tanggal
						</div>
						<div class="col-md-9">
							: <?= date("d-m-Y H:i:s", strtotime($model->tanggal)) ?>
						</div>
					</div>
				</div>
			</div>

			<hr>
			<?php echo $this->renderPartial('_tarif', array('model' => $model, 'modelBiaya' => $modelBiaya, 'modelTarif' => $modelTarif)); ?>
		</div>
	</div>
</section>