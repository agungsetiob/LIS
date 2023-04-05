<?php
$link = Yii::app()->controller->id;
$route = Yii::app()->controller->route;

// Menu Dasboard
$dashboard = "";

if ($route == "dashboard/index") {
    $dashboard = "active";
}
// Menu Dasboard

// Menu Referensi
$referensi = "";
$kode = "";
$kodem = "";
$dokter = "";
$pasien = "";
$ruang = "";
$petugas = "";
$instansi = "";
$paket = "";
$formula = "";
$parameter = "";
$user = "";
$log = "";

if ($link == "kode" or $link == "dokter" or $link == "pasien" or $link == "ruang" or $link == "petugas" or $link == "instansi" or $link == "paket" or $link == "parameter" or $link == "user" or $link == "log") {
    $referensi = "active";
}

if ($route == "kode/index" or $route == "kode/create" or $route == "kode/update" or $route == "kode/view") {
    $kode = "active";
}

if ($route == "kode/index2") {
    $kodem = "active";
}

if ($link == "dokter") {
    $dokter = "active";
}

if ($link == "pasien") {
    $pasien = "active";
}

if ($link == "ruang") {
    $ruang = "active";
}

if ($link == "petugas") {
    $petugas = "active";
}

if ($link == "paket") {
    $paket = "active";
}

if ($link == "formula") {
    $formula = "active";
}

if ($link == "instansi") {
    $instansi = "active";
}

if ($link == "parameter") {
    $parameter = "active";
}

if ($link == "user") {
    $user = "active";
}

if ($link == "log") {
    $log = "active";
}
// Menu Referensi

// Menu Pemeriksaan
$periksa = "";

if ($route == "periksa/index" or $route == "periksa/view") {
    $periksa = "active";
}
// Menu Pemeriksaan

// Menu Pending
$pending = "";

if ($route == "periksa/pending") {
    $pending = "active";
}
// Menu Pending

// Menu verifikasi
$verifikasi = "";

if ($route == "periksa/verifikasi") {
    $verifikasi = "active";
}
// Menu verifikasi

// Menu Biaya
$biaya = "";

if ($route == "periksa/biaya") {
    $biaya = "active";
}
// Menu Biaya

// Menu Biaya
$biaya = "";

if ($route == "periksa/konsultasi") {
    $konsultasi = "active";
}
// Menu Biaya

// Menu Hasil
$hasil = "";

if ($route == "periksa/hasil") {
    $hasil = "active";
}
// Menu Hasil

// Menu Result
$result = "";

if ($link == "result") {
    $result = "active";
}
// Menu Result

// Menu Database
$db = "";

if ($link == "db") {
    $db = "active";
}
// Menu Database

// Menu Laporan
$laporan = "";
$lpasien = "";
$lrujukan = "";
$litem = "";
$lgrup = "";
$lomzet = "";
$llr = "";
$lkritis = "";
$lkunjungan = "";
$lpemeriksaan = "";
$lrespon = "";

if ($link == "laporan") {
    $laporan = "active";
}

if ($route == "laporan/pasien0" or $route == "laporan/pasien5") {
    $lpasien = "active";
}

if ($route == "laporan/rujukan") {
    $lrujukan = "active";
}

if ($route == "laporan/kode") {
    $litem = "active";
}

if ($route == "laporan/grup") {
    $lgrup = "active";
}

if ($route == "laporan/kritis") {
    $lkritis = "active";
}

if ($route == "laporan/kunjungan" or $route == "laporan/kunjungan1" or $route == "laporan/kunjungan2" or $route == "laporan/kunjungan3") {
    $lkunjungan = "active";
}

if ($route == "laporan/pemeriksaan") {
    $lpemeriksaan = "active";
}

if($route=="laporan/respon"){
    $lrespon = "active";
}
// Menu Laporan

// Menu Ubah Password
$ubah = "";

if ($route == "dashboard/ubah") {
    $ubah = "active";
}
// Menu Ubah Password

// Menu Pemeriksaan SimRS
$periksalab = "";

if ($route == "rs/periksa") {
    $periksalab = "active";
}
// Menu Pemeriksaan SimRS
?>

<section class="sidebar">
    <div class="user-panel">
        <div class="pull-left image">
            <img src="<?php echo Yii::app()->theme->baseUrl; ?>/dist/img/doctor.png" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
            <p><?= Yii::app()->user->nama ?></p>
            <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
    </div>

    <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MENU</li>
        <li class="<?= $dashboard ?>"><a href="<?= Yii::app()->createUrl("dashboard") ?>"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>
        <?php if (Yii::app()->user->checkAccess('Referensi')) : ?>
            <li class="treeview <?= $referensi ?>">
                <a href="#">
                    <i class="fa fa-table"></i> <span>Referensi</span><span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
                </a>
                <ul class="treeview-menu">
                    <?php if (Yii::app()->user->checkAccess('Kode.*')) : ?>
                        <li class="<?= $kodem ?>"><a href="<?= Yii::app()->createUrl("kode/index2") ?>"><i class="fa fa-circle-o"></i>Pemeriksaan</a></li>
                    <?php endif ?>

                    <?php if (Yii::app()->user->checkAccess('Tarif.*')) : ?>
                        <li class="<?= $kodem ?>"><a href="<?= Yii::app()->createUrl("tarif") ?>"><i class="fa fa-circle-o"></i>Tarif</a></li>
                    <?php endif ?>

                    <?php if (Yii::app()->user->checkAccess('Paket.*')) : ?>
                        <li class="<?= $paket ?>"><a href="<?= Yii::app()->createUrl("paket") ?>"><i class="fa fa-circle-o"></i>Paket</a></li>
                    <?php endif ?>

                    <?php if (Yii::app()->user->checkAccess('Dokter.*')) : ?>
                        <li class="<?= $dokter ?>"><a href="<?= Yii::app()->createUrl("dokter") ?>"><i class="fa fa-circle-o"></i>Dokter</a></li>
                    <?php endif ?>

                    <?php if (Yii::app()->user->checkAccess('Pasien.*')) : ?>
                        <li class="<?= $pasien ?>"><a href="<?= Yii::app()->createUrl("pasien") ?>"><i class="fa fa-circle-o"></i>Pasien</a></li>
                    <?php endif ?>

                    <?php if (Yii::app()->user->checkAccess('Ruang.*')) : ?>
                        <li class="<?= $ruang ?>"><a href="<?= Yii::app()->createUrl("ruang") ?>"><i class="fa fa-circle-o"></i>Ruang</a></li>
                    <?php endif ?>

                    <?php if (Yii::app()->user->checkAccess('Petugas.*')) : ?>
                        <li class="<?= $petugas ?>"><a href="<?= Yii::app()->createUrl("petugas") ?>"><i class="fa fa-circle-o"></i>Petugas</a></li>
                    <?php endif ?>

                    <?php if (Yii::app()->user->checkAccess('Parameter.*')) : ?>
                        <li class="<?= $parameter ?>"><a href="<?= Yii::app()->createUrl("parameter") ?>"><i class="fa fa-circle-o"></i>Parameter</a></li>
                    <?php endif ?>

                    <?php if (Yii::app()->user->checkAccess('Log.*')) : ?>
                        <li class="<?= $log ?>"><a href="<?= Yii::app()->createUrl("log") ?>"><i class="fa fa-circle-o"></i>Log</a></li>
                    <?php endif ?>

                    <?php if (Yii::app()->user->id == '1') : ?>
                        <li class="<?= $user ?>"><a href="<?= Yii::app()->createUrl("user") ?>"><i class="fa fa-circle-o"></i>User</a></li>
                    <?php endif ?>
                </ul>
            </li>
        <?php endif ?>

        <?php if (Yii::app()->user->checkAccess('PeriksaSIMRS')) : ?>
            <li class="<?= $periksalab ?>"><a href="<?= Yii::app()->createUrl("rs/periksa") ?>"><i class="fa fa-file"></i> <span>Pemeriksaan SIMRS</span></a></li>
        <?php endif ?>

        <?php if (Yii::app()->user->checkAccess('PeriksaCreate')) : ?>
            <li class="<?= $periksa ?>"><a href="<?= Yii::app()->createUrl("periksa") ?>"><i class="fa fa-file-o"></i> <span>Pemeriksaan</span></a></li>
        <?php endif ?>

        <?php if (Yii::app()->user->checkAccess('PeriksaPending')) : ?>
            <li class="<?= $pending ?>"><a href="<?= Yii::app()->createUrl("periksa/pending") ?>"><i class="fa fa-exclamation-circle"></i> <span>Pending</span></a></li>
        <?php endif ?>

        <?php if (Yii::app()->user->checkAccess('PeriksaHasil')) : ?>
            <li class="<?= $hasil ?>"><a href="<?= Yii::app()->createUrl("periksa/hasil") ?>"><i class="fa fa-file-text"></i> <span>Hasil</span></a></li>
        <?php endif ?>

        <?php if (Yii::app()->user->checkAccess('Result.*')) : ?>
            <li class="<?= $result ?>"><a href="<?= Yii::app()->createUrl("result/grup") ?>"><i class="fa fa-list"></i> <span>Result</span></a></li>
        <?php endif ?>

        <?php if (Yii::app()->user->checkAccess('Db.*')) : ?>
            <li class="<?= $db ?>"><a href="<?= Yii::app()->createUrl("db") ?>"><i class="fa fa-database"></i> <span>Database</span></a></li>
        <?php endif ?>

        <?php if (Yii::app()->user->checkAccess('Laporan.*')) : ?>
            <li class="treeview <?= $laporan ?>">
                <a href="#">
                    <i class="fa fa-print"></i> <span>Laporan</span><span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
                </a>
                <ul class="treeview-menu">
                    <?php if (Yii::app()->user->checkAccess('Laporan.*')) : ?>
                        <li class="<?= $lkunjungan ?>"><a href="<?= Yii::app()->createUrl("laporan/kunjungan") ?>"><i class="fa fa-circle-o"></i>Kunjungan</a></li>
                        <li class="<?= $lpemeriksaan ?>"><a href="<?= Yii::app()->createUrl("laporan/pemeriksaan") ?>"><i class="fa fa-circle-o"></i>Pemeriksaan</a></li>
                        <li class="<?= $lpasien ?>"><a href="<?= Yii::app()->createUrl("laporan/pasien0") ?>"><i class="fa fa-circle-o"></i>Pasien</a></li>
                        <li class="<?= $lrujukan ?>"><a href="<?= Yii::app()->createUrl("laporan/rujukan") ?>"><i class="fa fa-circle-o"></i>Rujukan</a></li>
                        <li class="<?= $litem ?>"><a href="<?= Yii::app()->createUrl("laporan/kode") ?>"><i class="fa fa-circle-o"></i>Item</a></li>
                        <li class="<?= $lgrup ?>"><a href="<?= Yii::app()->createUrl("laporan/grup") ?>"><i class="fa fa-circle-o"></i>Grup</a></li>
                        <li class="<?= $lkritis ?>"><a href="<?= Yii::app()->createUrl("laporan/kritis") ?>"><i class="fa fa-circle-o"></i>Nilai Kritis</a></li>
                        <li class="<?= $lrespon ?>"><a href="<?= Yii::app()->createUrl("laporan/respon") ?>"><i class="fa fa-circle-o"></i>Respon Time</a></li>
                    <?php endif ?>
                </ul>
            </li>
        <?php endif ?>

        <?php if (Yii::app()->user->checkAccess('Dashboard.*')) : ?>
            <li class="<?= $ubah ?>"><a href="<?= Yii::app()->createUrl("dashboard/ubah") ?>"><i class="fa fa-cogs"></i> <span>Ubah Password</span></a></li>
        <?php endif ?>

        <!-- <li><a href="help.pdf" target="_blank"><i class="fa fa-book"></i> <span>Help</span></a></li> -->
    </ul>
</section>