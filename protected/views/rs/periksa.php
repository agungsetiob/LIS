<section class="content-header">
    <div class="btn-group">
    </div>

    <ol class="breadcrumb">
        <li><a href="<?= Yii::app()->createUrl("dashboard") ?>"><i class="fa fa-dashboard"></i> Dashboard </a></li>
        <li>Pemeriksaan SIMRS</li>
    </ol>
</section>

<section class="content">
    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title">Pemeriksaan SIMRS
            </h3>

            <div class="box-tools pull-right">

                <div class="col-md-6">
                    <input type="date" class="form-control" id="tanggal" value="<?= $tgl ?>">
                </div>
            </div>
        </div>

        <div class="box-body">

            <hr>
            <div class="table-responsive">
                <table id="datatableFormula" class="items table table-condensed table-hover table-striped">
                    <thead>
                        <tr>
                            <th>No Lab</th>
                            <th>Tgl Periksa</th>
                            <th>No RM</th>
                            <th>Nama Pasien</th>
                            <th>Dokter Pengirim</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 0;
                        foreach ($data as $d) {
                            echo "<tr>
								<td>$d[NOMOR]</td>
								<td>$d[TANGGAL]</td>
								<td>$d[NORM]</td>
								<td>$d[NAMA]</td>
								<td>$d[NAMA_DOKTER]</td>
								<td class='text-center'><a href='index.php?r=rs/tolis&id=$d[NOMOR]' class='btn btn-xs btn-warning'>Simpan Ke LIS</a></td>
							</tr>";

                            $no++;
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>

<script type="text/javascript">
    $(document).ready(function(e) {
        $('#datatableFormula').dataTable({});

        // Ubah Grup Pemeriksaan
        $('#tanggal').change(function() {
            var tgl = $(this).val();

            window.location.href = 'index.php?r=rs/periksa&tgl=' + tgl;
        });
    });
</script>