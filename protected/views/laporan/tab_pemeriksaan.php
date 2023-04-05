<?php $link = Yii::app()->controller->route; ?>

<ul class="nav nav-tabs">
    <li role="presentation" class="<?= ($link == "laporan/pemeriksaan") ? 'active' : '' ?>"><a href="<?= Yii::app()->createUrl("laporan/pemeriksaan") ?>">Pembayaran</a></li>
    <li role="presentation" class="<?= ($link == "laporan/pemeriksaan1") ? 'active' : '' ?>"><a href="<?= Yii::app()->createUrl("laporan/pemeriksaan1") ?>">Rawat Jalan BPJS</a></li>
</ul>
<br>