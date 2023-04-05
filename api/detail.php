<?php
$mysqli = new mysqli("192.168.0.200", "admin", "S!MRSGos2");

$id = isset($_GET['id']) ? $_GET['id'] : 0;

$result = $mysqli->query("SELECT a.NOMOR, a.TANGGAL, c.NORM, d.NAMA, d.TEMPAT_LAHIR, d.TANGGAL_LAHIR, d.JENIS_KELAMIN,
d.ALAMAT, e.NIP, CONCAT(f.GELAR_DEPAN, '. ', f.NAMA, ', ', f.GELAR_BELAKANG) AS NAMA_DOKTER, b.RUANGAN, g.DESKRIPSI
FROM layanan.order_lab a
LEFT JOIN pendaftaran.kunjungan b ON a.KUNJUNGAN = b.NOMOR
LEFT JOIN pendaftaran.pendaftaran c ON b.NOPEN = c.NOMOR
LEFT JOIN master.pasien d ON c.NORM = d.NORM
LEFT JOIN master.dokter e ON a.DOKTER_ASAL = e.ID
LEFT JOIN master.pegawai f ON e.NIP = f.NIP
LEFT JOIN master.ruangan g ON b.RUANGAN = g.ID
WHERE a.NOMOR = '$id'");
$row=$result->fetch_object();




$detail = $mysqli->query("SELECT a.NOMOR, b.TINDAKAN, c.NAMA
FROM layanan.order_lab a
LEFT JOIN layanan.order_detil_lab b ON a.NOMOR = b.ORDER_ID
LEFT JOIN master.tindakan c ON b.TINDAKAN = c.ID
WHERE a.NOMOR = '$id'");

  $responSub = array();

while ($rowd = mysqli_fetch_object($detail)) {
	$d['KODE'] = $rowd->TINDAKAN;
	$d['TINDAKAN'] = $rowd->NAMA;
	
	 array_push($responSub, $d);
}

$respon = array(
	'STATUS' => true,
	'NOMOR' => $row->NOMOR,
	'TANGGAL' => $row->TANGGAL,
	'NORM' => $row->NORM,
	'NAMA' => $row->NAMA,
	'TEMPAT_LAHIR' => "".$row->TEMPAT_LAHIR,
	'TANGGAL_LAHIR' => $row->TANGGAL_LAHIR,
	'JENIS_KELAMIN' => $row->JENIS_KELAMIN,
	'ALAMAT' => $row->ALAMAT,
	'KODE_DOKTER' => $row->NIP,
	'NAMA_DOKTER' => ($row->NAMA_DOKTER == "") ? "-" : $row->NAMA_DOKTER,
	'KODE_RUANGAN' => $row->RUANGAN,
	'NAMA_RUANGAN' => $row->DESKRIPSI,
	'PEMERIKSAAN' => $responSub,
);

$mysqli->query("UPDATE layanan.order_lab SET layanan.order_lab.STATUS = 2 WHERE layanan.order_lab.NOMOR = '$id'");

$mysqli -> close();

header('Content-Type: application/json; charset=utf-8');

echo json_encode($respon);