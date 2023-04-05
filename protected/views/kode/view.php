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
		<a class="btn btn-bitbucket btn-sm" href="<?= Yii::app()->createUrl("kode/index2") ?>">Kembali</a>
	</div>

	<ol class="breadcrumb">
		<li><a href="<?= Yii::app()->createUrl("dashboard") ?>"><i class="fa fa-dashboard"></i> Dashboard </a></li>
		<li><a href="<?= Yii::app()->createUrl("kode") ?>"> Kode </a></li>
		<li>Detail</li>
	</ol>
</section>

<section class="content">
	<div class="box box-info">
		<div class="box-header with-border">
			<h3 class="box-title">Detail Pemeriksaan</h3>

			<div class="box-tools pull-right">
			</div>
		</div>

		<div class="box-body">
			<div class="row">
				<div class="col-md-4">
					<b>Nama : </b> <?= $model->nama ?>
				</div>
				<div class="col-md-4">
					<b>LIS : </b> <?= $model->lis ?>
				</div>
				<div class="col-md-4">
					<b>Satuan : </b> <?= $model->satuan ?>
				</div>
			</div>

			<div class="row">
				<div class="col-md-4">
					<b>Grup 1 : </b> <?= $model->grup1 ?>
				</div>
				<div class="col-md-4">
					<b>Grup 2 : </b> <?= $model->grup2 ?>
				</div>
				<div class="col-md-4">
					<b>Grup 3 : </b> <?= $model->grup3 ?>
				</div>
			</div>

			<div class="row" >
				<div class="col-md-4">
					<b>Metode : </b> <?= $model->metoda ?>
				</div>
				<div class="col-md-4">
					<b><?= $model->getAttributeLabel('pembulatan') ?> : </b> <?= Parameter::item("cPembulatan", $model->pembulatan) ?>
				</div>

				<div class="col-md-4">
					<b><?= $model->getAttributeLabel('parameter') ?> : </b> <?= Parameter::item("cParameter", $model->parameter) ?>
				</div>
			</div>

			<hr>
			<div class="nav-tabs-custom">
				<ul class="nav nav-tabs">
					<li class="active"><a href="#rujukan" data-toggle="tab" aria-expanded="true">Rujukan</a></li>
					<li class=""><a href="#kritis" data-toggle="tab" aria-expanded="false">Kritis</a></li>
				</ul>

				<div class="tab-content">
					<div class="tab-pane active" id="rujukan">
						<table class="table table-bordered table-striped">
							<thead>
								<tr>
									<th>Sex</th>
									<th width="100px;">Umur 1</th>
									<th width="100px;">Umur 2</th>
									<th width="100px;">Waktu</th>
									<th>NR 1</th>
									<th>NR 2</th>
									<th>Rujukan</th>
									<th>Keterangan</th>
									<th></th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td><select class="form-control input-sm col-md-12" id="sex">
											<option value='0'></option>
											<?php
											foreach (Parameter::getItems("cSex") as $data) {
												echo "<option value='$data->id'>$data->nama</option>";
											}
											?>
										</select></td>
									<td><input type="text" class="form-control input-sm col-md-12" id="umur1"></td>
									<td><input type="text" class="form-control input-sm col-md-12" id="umur2"></td>
									<td><select class="form-control input-sm col-md-12" id="waktu">
											<option value='0'></option>
											<?php
											foreach (Parameter::getItems("cWaktu") as $data) {
												echo "<option value='$data->id'>$data->nama</option>";
											}
											?>
										</select></td>
									<td><input type="text" class="form-control input-sm col-md-12" id="nr1"></td>
									<td><input type="text" class="form-control input-sm col-md-12" id="nr2"></td>
									<td><input type="text" class="form-control input-sm col-md-12" id="nr"></td>
									<td><input type="text" class="form-control input-sm col-md-12" id="keterangan" maxlength="25"></td>
									<td><button class="btn btn-primary btn-xs"><i class="fa fa-plus add"></i></button></td>
								</tr>
							</tbody>
							<tbody id="detail"></tbody>
						</table>
					</div>

					<div class="tab-pane" id="kritis">
						<table class="table table-bordered table-striped">
							<thead>
								<tr>
									<th>Sex</th>
									<th width="100px;">Umur 1</th>
									<th width="100px;">Umur 2</th>
									<th width="100px;">Waktu</th>
									<th>NK 1</th>
									<th>NK 2</th>
									<th></th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td><select class="form-control input-sm col-md-12" id="sex1">
											<option value='0'></option>
											<?php
											foreach (Parameter::getItems("cSex") as $data) {
												echo "<option value='$data->id'>$data->nama</option>";
											}
											?>
										</select></td>
									<td><input type="text" class="form-control input-sm col-md-12" id="umur11"></td>
									<td><input type="text" class="form-control input-sm col-md-12" id="umur21"></td>
									<td><select class="form-control input-sm col-md-12" id="waktu1">
											<option value='0'></option>
											<?php
											foreach (Parameter::getItems("cWaktu") as $data) {
												echo "<option value='$data->id'>$data->nama</option>";
											}
											?>
										</select></td>
									<td><input type="text" class="form-control input-sm col-md-12" id="nk1"></td>
									<td><input type="text" class="form-control input-sm col-md-12" id="nk2"></td>
									<td><button class="btn btn-primary btn-xs"><i class="fa fa-plus add1"></i></button></td>
								</tr>
							</tbody>
							<tbody id="detailKritis"></tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<div class="modal fade" id="modal-kode">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Kode Lab</h4>
			</div>

			<div class="modal-body">
				<?php $this->renderPartial("/kode/lookup", array("model" => $kode)); ?>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	$(document).ready(function(e) {
		$("#detail").load("<?php echo Yii::app()->createUrl("KodeDetail/admin", array("id" => $model->id)); ?>");

		$("#detailKritis").load("<?php echo Yii::app()->createUrl("KodeKritis/admin", array("id" => $model->id)); ?>");

		$("#child").load("<?php echo Yii::app()->createUrl("kode/child", array("id" => $model->id)); ?>");

		$('#cari-kode').click(function(e) {
			e.preventDefault();
			$.fn.yiiGridView.update('kode-grid', {
				data: $(this).serialize()
			});
			$('#modal-kode').modal('show');
		});

		$(".add").click(function() {
			var dataForm = {
				id_kode: <?= $model->id ?>,
				sex: $("#sex").val(),
				umur1: $("#umur1").val(),
				umur2: $("#umur2").val(),
				waktu: $("#waktu").val(),
				nr1: $("#nr1").val(),
				nr2: $("#nr2").val(),
				nr: $("#nr").val(),
				keterangan: $("#keterangan").val(),
			};

			$.ajax({
				url: '<?php echo Yii::app()->createUrl("KodeDetail/create"); ?>',
				data: dataForm,
				type: "POST",
				success: function(data) {
					$("#detail").load("<?php echo Yii::app()->createUrl("KodeDetail/admin", array("id" => $model->id)); ?>");
					$("#keterangan").val('');
					$("#sex").val('0');
					$("#umur1").val('');
					$("#umur2").val('');
					$("#waktu").val('0');
					$("#nr1").val('');
					$("#nr2").val('');
					$("#nr").val('');
					$("#keterangan").val('');
				}
			});
		});

		$("#addChild").click(function() {
			$.ajax({
				url: '<?php echo Yii::app()->createUrl("kode/cadd"); ?>',
				data: {
					idParent: <?= $model->id ?>,
					id: $("#LaporanKode_kode").val()
				},
				type: "POST",
				success: function(data) {
					$("#child").load("<?php echo Yii::app()->createUrl("kode/child", array("id" => $model->id)); ?>");
					$("#LaporanKode_kode").val('0');
					$("#Laporan_nama_kode").val('');
					$("#Laporan_lis").val('');
				}
			});
		});

		$(".add1").click(function() {
			var dataForm = {
				id_kode: <?= $model->id ?>,
				sex: $("#sex1").val(),
				umur1: $("#umur11").val(),
				umur2: $("#umur21").val(),
				waktu: $("#waktu1").val(),
				nk1: $("#nk1").val(),
				nk2: $("#nk2").val(),
			};

			$.ajax({
				url: '<?php echo Yii::app()->createUrl("KodeKritis/create"); ?>',
				data: dataForm,
				type: "POST",
				success: function(data) {
					$("#detailKritis").load("<?php echo Yii::app()->createUrl("KodeKritis/admin", array("id" => $model->id)); ?>");
					$("#sex1").val('0');
					$("#umur11").val('');
					$("#umur21").val('');
					$("#waktu1").val('0');
					$("#nk1").val('');
					$("#nk2").val('');
				}
			});
		});
	});
</script>