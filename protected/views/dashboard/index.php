<section class="content-header">
    <div class="btn-group">
        <button type="button" class="btn btn-info btn-sm"><i class="fa fa-refresh"></i></button>
        <a class="btn btn-bitbucket btn-sm" href="<?= Yii::app()->createUrl("dashboard") ?>">Refresh</a>
    </div>

    <ol class="breadcrumb">
        <li><a href="<?= Yii::app()->createUrl("dashboard") ?>"><i class="fa fa-dashboard"></i> Dashboard </a></li>
    </ol>
</section>

<section class="content">
    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title"><?= Pengaturan::item('nama_rs') ?></h3>

            <div class="box-tools pull-right">

            </div>
        </div>

        <div class="box-body">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th class='text-center' width="1%">No</th>
                        <th class='text-center' width="20%">Tanggal</th>
                        <th class='text-center' width="20%">Pemeriksaan</th>
                        <th class='text-center' width="20%">Pending</th>
                        <th class='text-center' width="20%">Selesai</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    $total = 0;
                    $tPending = 0;
                    $tVerifikasi = 0;
                    $tSelesai = 0;
                    foreach ($model as $data) {
                        $jumlah = Periksa::getJumlahPeriksa($data['tanggal']);
                        $pending = Periksa::getStateJumlahPeriksa($data['tanggal'], 1);
                        $verifikasi = Periksa::getStateJumlahPeriksa($data['tanggal'], 2);
                        $selesai = Periksa::getStateJumlahPeriksa($data['tanggal'], 3);

                        echo "<tr>
                            <td class='text-center'>$no</td>
                            <td class='text-center'>" . Parameter::tglIndo($data['tanggal']) . "</td>
                            <td class='text-center'>$jumlah</td>
                            <td class='text-center'>$pending</td>
                            <td class='text-center'>$selesai</td>
                        </tr>";

                        $no++;
                        $total += $jumlah;
                        $tPending += $pending;
                        $tSelesai += $selesai;
                    }
                    ?>
                    <tr>
                        <th colspan="2">Total</th>
                        <th class="text-center"><?= $total ?></th>
                        <th class="text-center"><?= $tPending ?></th>
                        <th class="text-center"><?= $tSelesai ?></th>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</section>