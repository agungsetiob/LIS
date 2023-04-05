<?php $link = Yii::app()->controller->route; ?>

<ul class="nav nav-tabs">
    <li role="presentation" class="<?= ($link == "laporan/kunjungan") ? 'active' : '' ?>"><a href="<?= Yii::app()->createUrl("laporan/kunjungan") ?>">Jenis Kelamin</a></li>
    <li role="presentation" class="<?= ($link == "laporan/kunjungan1") ? 'active' : '' ?>"><a href="<?= Yii::app()->createUrl("laporan/kunjungan1") ?>">Usia</a></li>
    <li role="presentation" class="<?= ($link == "laporan/kunjungan2") ? 'active' : '' ?>"><a href="<?= Yii::app()->createUrl("laporan/kunjungan2") ?>">Pembayaran</a></li>
    <li role="presentation" class="<?= ($link == "laporan/kunjungan3") ? 'active' : '' ?>"><a href="<?= Yii::app()->createUrl("laporan/kunjungan3") ?>">Asal Pasien</a></li>
</ul>
<br>