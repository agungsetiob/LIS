<?php
$mysqli = new mysqli("192.168.0.200", "admin", "S!MRSGos2");

$id = isset($_GET['id']) ? $_GET['id'] : 0;

$result = $mysqli->query("SELECT a.NOMOR, b.TINDAKAN, c.NAMA
FROM layanan.order_lab a
LEFT JOIN layanan.order_detil_lab b ON a.NOMOR = b.ORDER_ID
LEFT JOIN master.tindakan c ON b.TINDAKAN = c.ID
WHERE a.NOMOR = '$id'");
$row=$result->fetch_object();

$respon = array(
	'status' => true,
	'NOMOR' => $row->NOMOR,
	'TINDAKAN' => $row->TINDAKAN,
	'NAMA' => $row->NAMA,
);

$mysqli -> close();

header('Content-Type: application/json; charset=utf-8');

echo json_encode($respon);