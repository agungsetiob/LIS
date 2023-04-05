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

<?php
$umur = Pasien::umur($model->idPasien->tgl_lahir);
// $aumur = explode(",", $umur);
$waktu = VPasien::getField($model->id_pasien, 'umur_hari');
$disabled = "";
$displaySelesai = "";
$displayCetak = "none";
$displayBatal = "none";
$displayValidasi = "none";
if ($model->state == 1) {
	// $disabled = "disabled";
	$displaySelesai = "none";
	if ($model->validasi == 1) {
		$displayCetak = "";
	}

	if (Yii::app()->user->id_level == 1) {
		$displayBatal = "";
	}

	if ($model->validasi == 0) {
		$displayValidasi = "";
	}
}

if (Yii::app()->user->id_level == 5) {
	$displaySelesai = "none";
}

$group1 = "selected";
$group2 = "";
$group3 = "";

if (isset($_GET['group']) and $_GET['group'] == 'alat') {
	$group1 = "";
	$group2 = "selected";
	$group3 = "";
}

if (isset($_GET['group']) and $_GET['group'] == 'hdt') {
	$group1 = "";
	$group2 = "";
	$group3 = "selected";
}
?>

<section class="content-header">
	<div class="btn-group">
		<button type="button" class="btn btn-info btn-sm"><i class="fa fa-chevron-left"></i></button>
		<a class="btn btn-bitbucket btn-sm" href="<?= Yii::app()->createUrl("periksa") ?>">Kembali</a>
	</div>

	<ol class="breadcrumb">
		<li><a href="<?= Yii::app()->createUrl("dashboard") ?>"><i class="fa fa-dashboard"></i> Dashboard </a></li>
		<li><a href="<?= Yii::app()->createUrl("periksa") ?>"> Periksa <div id="jumlah" style="display:none;"><?= $jumlah ?> </div> </a></li>
		<li>Detail</li>
	</ol>
</section>


<section class="content">
	<div class="box box-info">
		<div class="box-header with-border">
			<h3 class="box-title">Detail Periksa</h3>

			<div class="box-tools pull-right">
				<a href="<?= Yii::app()->createUrl("periksa/barcode", array("id" => $model->id)) ?>" target="_blank" class="btn btn-primary btn-sm">Barcode</a>
				<button type="button" class="btn btn-warning btn-sm" id="btn-refresh">Refresh</button>
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
								: <?= $model->idPasien->tgl_lahir ?> (<?= $umur ?>) <?= $waktu?> Hari
							</div>
						</div>
					</div>

					<div class="col-md-6">
						<div class="row">
							<div class="col-md-3">
								Dokter Pengirim
							</div>
							<div class="col-md-9">
								<select class="col-md-12 col-xs-12 select2" id="id-dokter">
									<?php
									$mDokter = Dokter::model()->findAll(array('condition' => 'kode=:id', 'params' => array(':id' => '1'), 'order' => 'nama'));
									foreach ($mDokter as $dDokter) {
										if ($model->id_dokter == $dDokter->id) {
											echo "<option value='$dDokter->id' selected>$dDokter->nama</option>";
										} else {
											echo "<option value='$dDokter->id'>$dDokter->nama</option>";
										}
									}
									?>
								</select>
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
								<select class="col-md-12 col-xs-12 select2" id="id-dokter2">
									<?php
									$mDokter2 = Dokter::model()->findAll(array('condition' => 'kode=:id', 'params' => array(':id' => '2'), 'order' => 'nama'));
									foreach ($mDokter2 as $dDokter2) {
										if ($model->id_dokter2 == $dDokter2->id) {
											echo "<option value='$dDokter2->id' selected>$dDokter2->nama</option>";
										} else {
											echo "<option value='$dDokter2->id'>$dDokter2->nama</option>";
										}
									}
									?>
								</select>
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
								<select class="col-md-12 col-xs-12 select2" id="id-ruang">
									<?php
									$mRuang = Ruang::model()->findAll(array('order' => 'nama'));
									foreach ($mRuang as $dRuang) {
										if ($model->id_ruang == $dRuang->id) {
											echo "<option value='$dRuang->id' selected>$dRuang->nama</option>";
										} else {
											echo "<option value='$dRuang->id'>$dRuang->nama</option>";
										}
									}
									?>
								</select>
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
								<select class="col-md-12 col-xs-12 select2" id="id-petugas">
									<option value='0'>-</option>
									<?php
									$criteria=new CDbCriteria;
									$criteria->compare('is_aktif', 1);
									$criteria->order = "nama";
							
									$mPetugas = Petugas::model()->findAll($criteria);
									foreach ($mPetugas as $dPetugas) {
										if ($model->id_petugas == $dPetugas->id) {
											echo "<option value='$dPetugas->id' selected>$dPetugas->nama</option>";
										} else {
											echo "<option value='$dPetugas->id'>$dPetugas->nama</option>";
										}
									}
									?>
								</select>
							</div>
						</div>
					</div>
				</div>

				<div class="row">
					<div class="col-md-6">
						<div class="row">
							<div class="col-md-3">
								Group By
							</div>
							<div class="col-md-9">
								<select class="col-md-12 col-xs-12 form-control input-sm" id="group">
									<option value="1" <?= $group1 ?>>Pemeriksaaan</option>
									<option value="3" <?= $group3 ?>>MDT</option>
									<option value="2" <?= $group2 ?>>Alat</option>
								</select>
							</div>
						</div>
					</div>

					<div class="col-md-6">
						<div class="row">
							<div class="col-md-3">
								Verifikasi
							</div>
							<div class="col-md-9">
								<select class="col-md-12 col-xs-12 select2" id="id-verifikasi">
									<option value='0'>-</option>
									<?php
									$criteria=new CDbCriteria;
									$criteria->compare('is_aktif', 1);
									$criteria->order = "nama";
							
									$mPetugas = Petugas::model()->findAll($criteria);
									foreach ($mPetugas as $dPetugas) {
										if ($model->id_verifikasi == $dPetugas->id) {
											echo "<option value='$dPetugas->id' selected>$dPetugas->nama</option>";
										} else {
											echo "<option value='$dPetugas->id'>$dPetugas->nama</option>";
										}
									}
									?>
								</select>
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
								<?php
								// echo "<select class='form-control col-md-12' id='note'> <option value='-'>-</option>";
								// $mp = Parameter::model()->findAll(array('condition' => 'jenis=:id', 'params' => array(':id' => 'cCatatan')));
								// foreach ($mp as $dp) {
								// 	if ($model->note == $dp->nama) {
								// 		echo "<option value='$dp->nama' selected>$dp->nama</option>";
								// 	} else {
								// 		echo "<option value='$dp->nama'>$dp->nama</option>";
								// 	}
								// }
								// echo "</select>";
								?>
								<input class="col-md-12 col-xs-12 form-control input-sm" id="ket_verifikasi" type="text" value="<?= $model->ket_verifikasi ?>">
							</div>
						</div>
					</div>

					<div class="col-md-6">
						<div class="row">
							<div class="col-md-3">
								Status Pasien
							</div>
							<div class="col-md-9">
								<?php
								echo "<select class='form-control col-md-12' id='penjamin'>";
								$mp = Parameter::model()->findAll(array('condition' => 'jenis=:id', 'params' => array(':id' => 'cPenjamin')));
								foreach ($mp as $dp) {
									if ($model->id_penjamin == $dp->id) {
										echo "<option value='$dp->id' selected>$dp->nama</option>";
									} else {
										echo "<option value='$dp->id'>$dp->nama</option>";
									}
								}
								echo "</select>";
								?>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="row">
				<div class="col-md-6">
					<div class="row">
						<div class="col-md-3">
							Diagnosa
						</div>
						<div class="col-md-9">
							<input class="col-md-12 col-xs-12 form-control input-sm" id="diagnosa" type="text" value="<?= $model->ket_klinik ?>">
						</div>
					</div>
				</div>

				<div class="col-md-6">
					<div class="row">
						<div class="col-md-3">
							Jenis Layanan
						</div>
						<div class="col-md-9">
							<?php
							echo "<select class='form-control col-md-12' id='jenis'>";
							$mjl = Parameter::model()->findAll(array('condition' => 'jenis=:id', 'params' => array(':id' => 'cJenisLayanan')));
							foreach ($mjl as $jl) {
								if ($model->id_jenis == $jl->id) {
									echo "<option value='$jl->id' selected>$jl->nama</option>";
								} else {
									echo "<option value='$jl->id'>$jl->nama</option>";
								}
							}
							echo "</select>";
							?>
						</div>
					</div>
				</div>
			</div>

			<hr>
			<div class="nav-tabs-custom">
				<ul class="nav nav-tabs">
					<li class="active"><a href="#lis" data-toggle="tab" aria-expanded="true">LIS</a></li>
					<li><a href="#simrs" data-toggle="tab" aria-expanded="true">SIMRS</a></li>
				</ul>

				<div class="tab-content">
					<div class="tab-pane active" id="lis">
						<?php echo $this->renderPartial('_hasil', array('model' => $model, 'waktu' => $waktu, 'disabled' => $disabled, 'displaySelesai' => $displaySelesai, 'displayCetak' => $displayCetak, 'displayBatal' => $displayBatal, 'displayValidasi' => $displayValidasi, 'modelKode' => $modelKode, 'KodePatient' => $model->nomor, 'modelPeriksa' => $modelPeriksa, 'modelResult' => $modelResult)); ?>
					</div>

					<div class="tab-pane" id="simrs">
						<?php echo $this->renderPartial('_simrs', array('model' => $model)); ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<script type="text/javascript">
	$(document).ready(function() {
		$('#group').change(function() {
			var id = $(this).val();
			if (id == 1) {
				window.location.href = 'index.php?r=periksa/view&id=<?= $model->id ?>';
			} else if (id == 2) {
				window.location.href = 'index.php?r=periksa/view&id=<?= $model->id ?>&group=alat';
			} else if (id == 3) {
				window.location.href = 'index.php?r=periksa/view&id=<?= $model->id ?>&group=hdt';
			}
		});

		$("#note").change(function(e) {
			$.ajax({
				type: "POST",
				data: {
					id: <?= $model->id ?>,
					field: 'note',
					note: $("#note").val()
				},
				url: "<?php echo Yii::app()->createUrl("periksa/update"); ?>",
				success: function(data) {
					if (data != "sukses") {
						alert("Error");
					}
				}
			})
		});

		$("#penjamin").change(function(e) {
			$.ajax({
				type: "POST",
				data: {
					id: <?= $model->id ?>,
					field: 'penjamin',
					penjamin: $("#penjamin").val()
				},
				url: "<?php echo Yii::app()->createUrl("periksa/update"); ?>",
				success: function(data) {
					if (data != "sukses") {
						alert("Error");
					}
				}
			})
		});

		$("#diagnosa").change(function(e) {
			$.ajax({
				type: "POST",
				data: {
					id: <?= $model->id ?>,
					field: 'ket_klinik',
					ket_klinik: $("#diagnosa").val()
				},
				url: "<?php echo Yii::app()->createUrl("periksa/update"); ?>",
				success: function(data) {
					if (data != "sukses") {
						alert("Error");
					}
				}
			})
		});

		$("#tgl_distribusi").change(function(e) {
			$.ajax({
				type: "POST",
				data: {
					id: <?= $model->id ?>,
					field: 'tgl_distribusi',
					tgl_distribusi: $("#tgl_distribusi").val()
				},
				url: "<?php echo Yii::app()->createUrl("periksa/update"); ?>",
				success: function(data) {
					if (data != "sukses") {
						alert("Error");
					}
				}
			})
		});

		$("#jenis").change(function(e) {
			$.ajax({
				type: "POST",
				data: {
					id: <?= $model->id ?>,
					field: 'id_jenis',
					id_jenis: $("#jenis").val()
				},
				url: "<?php echo Yii::app()->createUrl("periksa/update"); ?>",
				success: function(data) {
					if (data != "sukses") {
						alert("Error");
					}
				}
			})
		});

		$('#btn-refresh').click(function() {
			location.reload();
		});

		$('#btn-cetak').click(function() {
			url = 'index.php?r=periksa/cetak&id=<?= $model->id ?>';
			var win = window.open(url, '_blank');
			win.focus();

			// url = 'index.php?r=rs/kirim&no=<?= $model->nomor ?>';
			// var win = window.open(url, '_blank');
			// win.focus();
		});

		$('#btn-selesai').click(function() {
			var sure = confirm("Selesai Pemeriksaan ?");

			if (sure) {
				$.ajax({
					type: 'POST',
					url: '<?php echo Yii::app()->createUrl("periksa/selesai"); ?>',
					data: {
						id: <?= $model->id ?>,
					},
					success: function(data) {
						window.location.href = 'index.php?r=periksa/view&id=<?= $model->id ?>';
						// window.location.href = 'index.php?r=periksa/pending';
					}
				});
			}
		});

		$('#btn-cetak-gdt').click(function() {
			url = 'index.php?r=periksa/cetakgdt&id=<?= $model->id ?>';
			var win = window.open(url, '_blank');
			win.focus();
		});

		$('#btn-antigen').click(function() {
			url = 'index.php?r=periksa/cetakcovid&id=<?= $model->id ?>';
			var win = window.open(url, '_blank');
			win.focus();
		});

		$('#btn-cetak-pcr').click(function() {
			url = 'index.php?r=periksa/cetakpcr&id=<?= $model->id ?>';
			var win = window.open(url, '_blank');
			win.focus();
		});

		$('#btn-surat-pcr').click(function() {
			url = 'index.php?r=periksa/suratpcr&id=<?= $model->id ?>';
			var win = window.open(url, '_blank');
			win.focus();
		});

		$(".nilai").change(function() {
			var id = $(this).attr("data-id");
			var no = $(this).attr("data-no");
			var value = $(this).val();

			var a = parseInt(no) + 1;

			$.ajax({
				type: 'POST',
				url: '<?php echo Yii::app()->createUrl("result/nilai"); ?>',
				data: {
					id: id,
					value: value,
				},
				success: function(data) {
					$('#' + a).focus().select();
				}
			});
		});

		$(".keterangan").change(function() {
			var id = $(this).attr("data-id");
			var value = $(this).val();

			$.ajax({
				type: 'POST',
				url: '<?php echo Yii::app()->createUrl("result/keterangan"); ?>',
				data: {
					id: id,
					value: value,
				},
				success: function(data) {

				}
			});
		});

		$(".acc").click(function() {
			var id = $(this).attr("data-id");
			var value = $(this).is(':checked');
			$.ajax({
				type: 'POST',
				url: '<?php echo Yii::app()->createUrl("result/acc"); ?>',
				data: {
					id: id,
					value: value,
				},
				success: function(data) {

				}
			});
		});

		$(".gacc").click(function() {
			var id = $(this).attr("data-id");
			var nomor = $(this).attr("data-nomor");
			var value = $(this).is(':checked');
			$.ajax({
				type: 'POST',
				url: '<?php echo Yii::app()->createUrl("result/gacc"); ?>',
				data: {
					id: id,
					value: value,
					nomor: nomor,
				},
				success: function(data) {
					location.reload();
				}
			});
		});

		$(".add").click(function() {
			var dataForm = {
				KodePatient: <?= $model->nomor ?>,
				KodeParamater: $("#KodeParamater").val(),
				Nilai: $("#Nilai").val(),
			};

			$.ajax({
				url: '<?php echo Yii::app()->createUrl("result/create"); ?>',
				data: dataForm,
				type: "POST",
				success: function(data) {
					location.reload();
				}
			});
		});

		$(".delete").on("click", function(e) {
			var id = $(this).attr("data-id");
			$.ajax({
				type: "POST",
				url: "<?php echo Yii::app()->createUrl("result/delete"); ?>",
				data: {
					id: id
				},
				success: function(data) {
					location.reload();
				}
			});
		});

		setInterval(cekData, 180000);

		function cekData() {
			var jumlah = parseInt($("#jumlah").text());
			$.ajax({
				type: "POST",
				url: "<?php echo Yii::app()->createUrl("result/cek"); ?>",
				data: {
					KodePatient: <?= $model->nomor ?>
				},
				success: function(data) {
					if (data != jumlah) {
						location.reload();
					}
				}
			});
		}

		$('#btn-batal').click(function() {
			var sure = confirm("Pemeriksaan Tambahan ?");

			if (sure) {
				$.ajax({
					type: 'POST',
					url: '<?php echo Yii::app()->createUrl("periksa/batal"); ?>',
					data: {
						id: <?= $model->id ?>,
					},
					success: function(data) {
						window.location.href = 'index.php?r=periksa/view&id=<?= $model->id ?>';
						// window.location.href = 'index.php?r=periksa/hasil';
					}
				});
			}
		});

		$('#btn-validasi').click(function() {
			var sure = confirm("Validasi Pemeriksaan ?");

			if (sure) {
				$.ajax({
					type: 'POST',
					url: '<?php echo Yii::app()->createUrl("periksa/validasi"); ?>',
					data: {
						id: <?= $model->id ?>,
					},
					success: function(data) {
						window.location.href = 'index.php?r=periksa/view&id=<?= $model->id ?>';
					}
				});
			}
		});

		$("#id-ruang").change(function(e) {
			$.ajax({
				type: "POST",
				data: {
					id: <?= $model->id ?>,
					field: 'id_ruang',
					id_ruang: $("#id-ruang").val()
				},
				url: "<?php echo Yii::app()->createUrl("periksa/update"); ?>",
				success: function(data) {
					if (data != "sukses") {
						alert("Error");
					}
				}
			})
		});

		$("#id-petugas").change(function(e) {
			$.ajax({
				type: "POST",
				data: {
					id: <?= $model->id ?>,
					field: 'id_petugas',
					id_petugas: $("#id-petugas").val()
				},
				url: "<?php echo Yii::app()->createUrl("periksa/update"); ?>",
				success: function(data) {
					if (data != "sukses") {
						alert("Error");
					}
				}
			})
		});

		$("#id-verifikasi").change(function(e) {
			$.ajax({
				type: "POST",
				data: {
					id: <?= $model->id ?>,
					field: 'id_verifikasi',
					id_verifikasi: $("#id-verifikasi").val()
				},
				url: "<?php echo Yii::app()->createUrl("periksa/update"); ?>",
				success: function(data) {
					if (data != "sukses") {
						alert("Error");
					}
				}
			})
		});

		$("#id-dokter").change(function(e) {
			$.ajax({
				type: "POST",
				data: {
					id: <?= $model->id ?>,
					field: 'id_dokter',
					id_dokter: $("#id-dokter").val()
				},
				url: "<?php echo Yii::app()->createUrl("periksa/update"); ?>",
				success: function(data) {
					if (data != "sukses") {
						alert("Error");
					}
				}
			})
		});

		$("#id-dokter2").change(function(e) {
			$.ajax({
				type: "POST",
				data: {
					id: <?= $model->id ?>,
					field: 'id_dokter2',
					id_dokter2: $("#id-dokter2").val()
				},
				url: "<?php echo Yii::app()->createUrl("periksa/update"); ?>",
				success: function(data) {
					if (data != "sukses") {
						alert("Error");
					}
				}
			})
		});

		$("#ket_verifikasi").change(function(e) {
			$.ajax({
				type: "POST",
				data: {
					id: <?= $model->id ?>,
					field: 'ket_verifikasi',
					ket_verifikasi: $("#ket_verifikasi").val()
				},
				url: "<?php echo Yii::app()->createUrl("periksa/update"); ?>",
				success: function(data) {
					if (data != "sukses") {
						alert("Error");
					}
				}
			})
		});

		$("#btn-kode-alat").click(function() {
			$("#modal-kode-alat").modal('show');
		});
	});
</script>