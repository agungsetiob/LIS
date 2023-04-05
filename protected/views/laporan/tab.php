<?php $link = Yii::app()->controller->route; ?>

<ul class="nav nav-tabs">
    <li role="presentation" class="<?= ($link=="laporan/pasien0") ? 'active' : '' ?>"><a href="<?= Yii::app()->createUrl("laporan/pasien0") ?>">DETAIL</a></li>
    <!-- <li role="presentation" class="<?= ($link=="laporan/pasien") ? 'active' : '' ?>"><a href="<?= Yii::app()->createUrl("laporan/pasien") ?>">BPJS</a></li> -->
    <!-- <li role="presentation" class="<?= ($link=="laporan/pasien1") ? 'active' : '' ?>"><a href="<?= Yii::app()->createUrl("laporan/pasien1") ?>">MCU</a></li> -->
    <!-- <li role="presentation" class="<?= ($link=="laporan/pasien2") ? 'active' : '' ?>"><a href="<?= Yii::app()->createUrl("laporan/pasien2") ?>">UMUM</a></li> -->
    <!-- <li role="presentation" class="<?= ($link=="laporan/pasien3") ? 'active' : '' ?>"><a href="<?= Yii::app()->createUrl("laporan/pasien3") ?>">SEMUA</a></li> -->
    <!-- <li role="presentation" class="<?= ($link=="laporan/pasien4") ? 'active' : '' ?>"><a href="<?= Yii::app()->createUrl("laporan/pasien4") ?>">WAKTU</a></li> -->
    <li role="presentation" class="<?= ($link=="laporan/pasien5") ? 'active' : '' ?>"><a href="<?= Yii::app()->createUrl("laporan/pasien5") ?>">REKAP</a></li>
</ul>
<br>