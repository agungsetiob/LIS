<section class="content-header">
	<div class="btn-group">
		<button type="button" class="btn btn-info btn-sm"><i class="fa fa-chevron-left"></i></button>
		<a class="btn btn-bitbucket btn-sm" href="<?= Yii::app()->createUrl("periksa/konsultasi") ?>">Kembali</a>
	</div>

	<ol class="breadcrumb">
		<li><a href="<?= Yii::app()->createUrl("dashboard") ?>"><i class="fa fa-dashboard"></i> Dashboard </a></li>
		<li><a href="<?= Yii::app()->createUrl("periksa/konsultasi") ?>"> Konsultasi </a></li>
		<li>Detail</li>
	</ol>
</section>


<section class="content">
	<div class="box box-info">
		<div class="box-header with-border">
			<h3 class="box-title">Detail Konsultasi Pemeriksaan</h3>

			<div class="box-tools pull-right">
				<button type="button" class="btn btn-box-tool" id="btn-refresh" data-toggle="tooltip" title="Refresh"><i class="fa fa-refresh"></i></button>
			</div>
		</div>

		<div class="box-body">
			<div class="header">

				<div class="row">
					<div class="col-md-6">
						<div class="row">
							<div class="col-md-3">
								No. RM
							</div>
							<div class="col-md-9">
								: <?= $model->idPasien->no_rm ?>
							</div>
						</div>
					</div>

					<div class="col-md-6">
						<div class="row">
							<div class="col-md-3">
								No. Lab/No. Reg
							</div>
							<div class="col-md-9">
								: <?= $model->nomor ?>/<?= $model->no_reg ?>
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

				<div class="row">
					<div class="col-md-6">
						<div class="row">
							<div class="col-md-3">
								Tanggal Lahir
							</div>
							<div class="col-md-9">
								: <?= $model->idPasien->tgl_lahir ?> (<?= $umur ?>)
							</div>
						</div>
					</div>

					<div class="col-md-6">
						<div class="row">
							<div class="col-md-3">
								Dokter Pengirim
							</div>
							<div class="col-md-9">
								<?= Dokter::item($model->id_dokter) ?>
							</div>
						</div>
					</div>
				</div>

				<div class="row">
					<div class="col-md-6">
						<div class="row">
							<div class="col-md-3">
								Jenis Kelamin
							</div>
							<div class="col-md-9">
								: <?= Parameter::item("cSex", $model->idPasien->gender) ?>
							</div>
						</div>
					</div>

					<div class="col-md-6">
						<div class="row">
							<div class="col-md-3">
								Dokter Penanggung Jawab
							</div>
							<div class="col-md-9">
								<?= Dokter::item($model->id_dokter2) ?>
							</div>
						</div>
					</div>
				</div>

				<div class="row">
					<div class="col-md-6">
						<div class="row">
							<div class="col-md-3">
								Alamat
							</div>
							<div class="col-md-9">
								: <?= $model->idPasien->alamat ?>
							</div>
						</div>
					</div>

					<div class="col-md-6">
						<div class="row">
							<div class="col-md-3">
								Ruangan/Poli
							</div>
							<div class="col-md-9">
								<?= Ruang::item($model->id_ruang) ?>
							</div>
						</div>
					</div>
				</div>

				<div class="row">
					<div class="col-md-6">
						<div class="row">
							<div class="col-md-3">
								Periksa
							</div>
							<div class="col-md-9">
								: <?= date("d-m-Y", strtotime($model->tanggal)) . ' (' . date("H:i:s", strtotime($model->tanggal)) . ')' ?>
								<?php
								if ($model->state == 1) {
									echo "- " . date("d-m-Y", strtotime($model->selesai)) . ' (' . date("H:i:s", strtotime($model->selesai)) . ')';
								}
								?>
							</div>
						</div>
					</div>

					<div class="col-md-6">
						<div class="row">
							<div class="col-md-3">
								Petugas
							</div>
							<div class="col-md-9">
								<?= Petugas::item($model->id_petugas) ?>
							</div>
						</div>
					</div>
				</div>

				<div class="row">
					<div class="col-md-6">
						<div class="row">
							<div class="col-md-3">
								Catatan
							</div>
							<div class="col-md-9">
								<?= $model->note ?>
							</div>
						</div>
					</div>

					<div class="col-md-6">
						<div class="row">
							<div class="col-md-3">
								Status Pasien
							</div>
							<div class="col-md-9">
								<?= Parameter::item("cPenjamin", $model->id_penjamin) ?>
							</div>
						</div>
					</div>
				</div>
			</div>

			<hr>
			<div class="nav-tabs-custom">
				<ul class="nav nav-tabs">
					<li class="active"><a href="#lis" data-toggle="tab" aria-expanded="true">Hasil</a></li>
					<li><a href="#konsultasi" data-toggle="tab" aria-expanded="true">Konsultasi</a></li>
				</ul>

				<div class="tab-content">
					<div class="tab-pane active" id="lis">
						<?php echo $this->renderPartial('_hasil_konsultasi', array('model' => $model)); ?>
					</div>

					<div class="tab-pane" id="konsultasi">
						<div class="input-group">
							<input type="text" class="form-control" id="pesan"> <span class="input-group-addon"><i class="fa fa-send" id="kirimPesan"></i></span>
						</div>
						<hr>
						<?php echo $this->renderPartial('_konsultasi', array('model' => $konsultasi)); ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<script type="text/javascript">
	$(document).ready(function(e) {
		$("#kirimPesan").click(function() {
			$.ajax({
				url: '<?php echo Yii::app()->createUrl("periksa/AddKonsultasi"); ?>',
				data: {
					periksa_id: <?= $model->id ?>,
					pesan: $("#pesan").val()
				},
				type: "POST",
				success: function(data) {
					location.reload()
				}
			});
		});
	});
</script>