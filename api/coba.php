<?php
$koneksi = mysqli_connect("192.168.0.200", "admin", "S!MRSGos2");

$id = isset($_GET['id']) ? $_GET['id'] : 0;

$sql = mysqli_query($koneksi, "SELECT * FROM layanan.order_lab WHERE layanan.order_lab.NOMOR = '121010201022302140001'");
$data = mysqli_fetch_array($sql);

$respon = array(
	'NOMOR' => $data['NOMOR'],
);

header('Content-Type: application/json; charset=utf-8');

echo json_encode($respon);