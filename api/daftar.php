<?php
$mysqli = new mysqli("192.168.0.200", "admin", "S!MRSGos2");

$id = isset($_GET['tgl']) ? $_GET['tgl'] : date("Y-m-d");

$result = $mysqli->query("SELECT a.NOMOR, a.TANGGAL, c.NORM, d.NAMA, CONCAT(f.GELAR_DEPAN, '. ', f.NAMA, ', ', f.GELAR_BELAKANG) AS NAMA_DOKTER
FROM layanan.order_lab a
LEFT JOIN pendaftaran.kunjungan b ON a.KUNJUNGAN = b.NOMOR
LEFT JOIN pendaftaran.pendaftaran c ON b.NOPEN = c.NOMOR
LEFT JOIN master.pasien d ON c.NORM = d.NORM
LEFT JOIN master.dokter e ON a.DOKTER_ASAL = e.ID
LEFT JOIN master.pegawai f ON e.NIP = f.NIP
WHERE a.TANGGAL LIKE '%$id%' AND a.STATUS = '1'");

$respon = array();

while ($row = mysqli_fetch_object($result)) {
	$d['NOMOR'] = $row->NOMOR;
	$d['TANGGAL'] = $row->TANGGAL;
	$d['NORM'] = $row->NORM;
	$d['NAMA'] = $row->NAMA;
	$d['NAMA_DOKTER'] = "".$row->NAMA_DOKTER;
	
	array_push($respon, $d);
}


$mysqli -> close();

header('Content-Type: application/json; charset=utf-8');

echo json_encode($respon);