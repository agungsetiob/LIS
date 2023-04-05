<?php
$mysqli = new mysqli("192.168.0.200", "admin", "S!MRSGos2", "master");

$id = isset($_GET['id']) ? $_GET['id'] : 0;

$result = $mysqli->query("SELECT * FROM pasien WHERE NORM = $_GET[id]");
$row=$result->fetch_object();

$respon = array(
	'status' => true,
	'no_rm' => $row->NORM,
	'nama' => $row->NAMA,
	'tempat_lahir' => $row->TEMPAT_LAHIR,
	'tgl_lahir' => $row->TANGGAL_LAHIR,
	'gender' => $row->JENIS_KELAMIN,
	'alamat' => $row->ALAMAT,
);

$mysqli -> close();

header('Content-Type: application/json; charset=utf-8');

echo json_encode($respon);