<?php

class Laporan
{
    public static function getKunjunganJK($jk, $awal, $akhir)
    {
        $sql = "SELECT COUNT(*) AS total FROM periksa a LEFT JOIN pasien b ON a.id_pasien = b.id WHERE a.state = '1' AND a.validasi = '1' AND b.gender = '$jk' AND DATE(a.tanggal) BETWEEN '$awal' AND '$akhir'";
        $data = Yii::app()->db->createCommand($sql)->queryRow();

        return $data['total'];;
    }

    public static function getKunjunganPembayaran($pembayaran, $awal, $akhir)
    {
        $sql = "SELECT COUNT(*) AS total FROM periksa a LEFT JOIN pasien b ON a.id_pasien = b.id WHERE a.state = '1' AND a.validasi = '1' AND b.state = '$pembayaran' AND DATE(a.tanggal) BETWEEN '$awal' AND '$akhir'";
        $data = Yii::app()->db->createCommand($sql)->queryRow();

        return $data['total'];;
    }

    public static function getKunjunganAsal($asal, $awal, $akhir)
    {
        $sql = "SELECT COUNT(*) AS total FROM periksa a LEFT JOIN pasien b ON a.id_pasien = b.id WHERE a.state = '1' AND a.validasi = '1' AND a.id_ruang = '$asal' AND DATE(a.tanggal) BETWEEN '$awal' AND '$akhir'";
        $data = Yii::app()->db->createCommand($sql)->queryRow();

        return $data['total'];;
    }

    public static function getKunjunganUsia($usia, $awal, $akhir)
    {
        $sql = "SELECT COUNT(*) AS total FROM periksa a LEFT JOIN v_pasien b ON a.id_pasien = b.id WHERE a.state = '1' AND a.validasi = '1' AND DATE(a.tanggal) BETWEEN '$awal' AND '$akhir'";
        if ($usia == 1) {
            $sql .= " AND b.umur BETWEEN '0' AND '1'";
        } else if ($usia == 2) {
            $sql .= " AND b.umur BETWEEN '1' AND '13'";
        } else if ($usia == 3) {
            $sql .= " AND b.umur BETWEEN '14' AND '40'";
        } else if ($usia == 4) {
            $sql .= " AND b.umur BETWEEN '41' AND '60'";
        } else if ($usia == 5) {
            $sql .= " AND b.umur BETWEEN '61' AND '150'";
        }
        $data = Yii::app()->db->createCommand($sql)->queryRow();

        return $data['total'];;
    }

    public static function getPemeriksaan($tanggal, $pemeriksaan)
    {
        $sql = "SELECT COUNT(*) AS total FROM result WHERE DATE(tanggal) = '$tanggal' AND KodeParamater = '$pemeriksaan' AND acc = '1'";
        $data = Yii::app()->db->createCommand($sql)->queryRow();

        return $data['total'];
    }
}
