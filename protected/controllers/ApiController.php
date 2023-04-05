<?php

class ApiController extends Controller
{
    public function actionIndex()
    {
        $respon = array(
            "status" => "sukses",
            "app_name" => "LIS Yamhatevy",
        );

        echo json_encode($respon);
    }

    public function actionLogin()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $versiUpdate = "1.4.3";
            $username = isset($_POST['username']) ? $_POST['username'] : 'XXX';
            $password = isset($_POST['password']) ? md5($_POST['password']) : 'XXX';
            $token = isset($_POST['token']) ? $_POST['token'] : '';
            $hp = isset($_POST['hp']) ? $_POST['hp'] : '';
            $versi = isset($_POST['versi']) ? $_POST['versi'] : '1.1.1';
            $tanggal = date("Y-m-d H:i:s");

            if ($versi == $versiUpdate) {
                $sql = "SELECT COUNT(*) as total, a.* FROM android a WHERE a.username='$username' AND a.password='$password' AND a.is_aktif='1'";
                $data = Yii::app()->db->createCommand($sql)->queryRow();

                if ($data['total'] > 0) {
                    Yii::app()->db->createCommand("UPDATE android SET token_android = '$token', login_android = '$tanggal' WHERE username = '$username'")->execute();
                    Yii::app()->db->createCommand("INSERT INTO android_log (username, waktu, hp) VALUES ('$username', '$tanggal', '$hp')")->execute();

                    $respon = array(
                        "status" => "sukses",
                        "username" => $data['username'],
                        "nama" => $data['nama'],
                        "id_level" => $data['id_level'],
                        "id_dokter" => $data['id_dokter'],
                        "server" => $data['server'],
                        "pdf" => $data['pdf_server'],
                    );
                } else {
                    $respon = array(
                        "status" => "gagal",
                        "pesan" => "Login Gagal",
                    );
                }
            } else {
                $respon = array(
                    "status" => "versi",
                    "pesan" => "Silahkan update ke versi " . $versiUpdate,
                );
            }
        } else {
            $respon = array(
                "status" => "gagal",
                "message" => "Error Methods",
            );
        }

        echo json_encode($respon);
    }

    public function actionGanti()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $username = isset($_POST['username']) ? $_POST['username'] : 'XXX';
            $password = isset($_POST['password']) ? md5($_POST['password']) : 'XXX';

            $sql = "UPDATE android SET password='$password' WHERE username='$username'";
            $proses = Yii::app()->db->createCommand($sql)->execute();

            if ($proses) {
                $respon = array(
                    "status" => "sukses",
                    "message" => "Ganti password berhasil",
                );
            } else {
                $respon = array(
                    "status" => "gagal",
                    "message" => "Ganti password gagal",
                );
            }
        } else {
            $respon = array(
                "status" => "gagal",
                "message" => "Error Methods",
            );
        }

        echo json_encode($respon);
    }

    public function actionDash()
    {
        if ($_SERVER["REQUEST_METHOD"] == "GET") {
            $tanggal = date('Y-m-d');
            $tahun = date('Y');
            $bulan = date("m");

            // Pemeriksaan
            $sql = "SELECT count(*) as jumlah FROM periksa WHERE MONTH(tanggal)='$bulan' AND YEAR(tanggal)='$tahun' AND state!='3'";
            $data = Yii::app()->db->createCommand($sql)->queryRow();
            // Pemeriksaan

            // Pending
            $sql2 = "SELECT count(*) as jumlah FROM periksa WHERE MONTH(tanggal)='$bulan' AND YEAR(tanggal)='$tahun' AND state='0'";
            $data2 = Yii::app()->db->createCommand($sql2)->queryRow();
            // Pending

            // Selesai
            $sql3 = "SELECT count(*) as jumlah FROM periksa WHERE MONTH(tanggal)='$bulan' AND YEAR(tanggal)='$tahun' AND state='1'";
            $data3 = Yii::app()->db->createCommand($sql3)->queryRow();
            // Selesai

            // Selesai Belum Validasi
            $sql4 = "SELECT count(*) as jumlah FROM periksa WHERE MONTH(tanggal)='$bulan' AND YEAR(tanggal)='$tahun' AND state='1' AND validasi = '0'";
            $data4 = Yii::app()->db->createCommand($sql4)->queryRow();
            // Selesai Belum Validasi

            // Selesai Sudah Validasi
            $sql5 = "SELECT count(*) as jumlah FROM periksa WHERE MONTH(tanggal)='$bulan' AND YEAR(tanggal)='$tahun' AND state='1' AND validasi = '1'";
            $data5 = Yii::app()->db->createCommand($sql5)->queryRow();
            // Selesai Sudah Validasi

            $respon = array(
                'rs' => Pengaturan::item('nama_rs'),
                'periode' => Parameter::getBulan($tanggal) . " " . $tahun,
                'pemeriksaan' => $data['jumlah'],
                'pending' => $data2['jumlah'],
                'selesai' => $data3['jumlah'],
                'belum_validasi' => $data4['jumlah'],
                'sudah_validasi' => $data5['jumlah'],
            );
        } else {
            $respon = array(
                "status" => "gagal",
                "message" => "Error Methods",
            );
        }

        echo json_encode($respon);
    }

    // API Pemeriksaan Pending
    public function actionPending()
    {
        if ($_SERVER["REQUEST_METHOD"] == "GET") {
            $tahun = date('Y');
            $bulan = date("m");
            $idDokter = isset($_GET['id']) ? $_GET['id'] : '0';

            if($idDokter !=0) {
                $sql = "SELECT a.id, a.nomor, a.tanggal, b.no_rm, b.nama, a.id_dokter, a.id_dokter2, a.id_petugas, a.id_ruang, a.validasi FROM periksa a LEFT JOIN pasien b ON a.id_pasien=b.id WHERE MONTH(a.tanggal) = '$bulan' AND YEAR(a.tanggal) = '$tahun' AND a.state = '0' AND a.validasi = '0'  AND a.id_dokter2 = '$idDokter' ORDER BY a.nomor DESC";
            } else {
                $sql = "SELECT a.id, a.nomor, a.tanggal, b.no_rm, b.nama, a.id_dokter, a.id_dokter2, a.id_petugas, a.id_ruang, a.validasi FROM periksa a LEFT JOIN pasien b ON a.id_pasien=b.id WHERE MONTH(a.tanggal) = '$bulan' AND YEAR(a.tanggal) = '$tahun' AND a.state = '0' AND a.validasi = '0' ORDER BY a.nomor DESC";
            }

            $model = Yii::app()->db->createCommand($sql)->queryAll();

            $respon = array();

            foreach ($model as $data) {
                $d['id'] = $data['id'];
                $d['nomor'] = $data['nomor'];
                $d['tanggal'] = date("d-m-Y", strtotime($data['tanggal']));
                $d['no_rm'] = $data['no_rm'];
                $d['nama_pasien'] = $data['nama'];
                $d['dokter_pengirim'] = Dokter::item($data['id_dokter']);
                $d['dokter_pj'] = Dokter::item($data['id_dokter2']);
                $d['petugas'] = Petugas::item($data['id_petugas']);
                $d['ruangan'] = Ruang::item($data['id_ruang']);
                $d['validasi'] = $data['validasi'];

                array_push($respon, $d);
            }
        } else {
            $respon = array(
                "status" => "gagal",
                "message" => "Error Methods",
            );
        }

        echo json_encode($respon);
    }
    // API Pemeriksaan Pending

    // API Pemeriksaan Validasi
    public function actionValidasi()
    {
        if ($_SERVER["REQUEST_METHOD"] == "GET") {
            $tahun = date('Y');
            $bulan = date("m");
            $idDokter = isset($_GET['id']) ? $_GET['id'] : '0';

            if($idDokter !=0) {
                $sql = "SELECT a.id, a.nomor, a.tanggal, b.no_rm, b.nama, a.id_dokter, a.id_dokter2, a.id_petugas, a.id_ruang, a.validasi FROM periksa a LEFT JOIN pasien b ON a.id_pasien=b.id WHERE MONTH(a.tanggal) = '$bulan' AND YEAR(a.tanggal) = '$tahun' AND a.state = '1' AND a.validasi = '0'  AND a.id_dokter2 = '$idDokter' ORDER BY a.nomor DESC";
            } else {
                $sql = "SELECT a.id, a.nomor, a.tanggal, b.no_rm, b.nama, a.id_dokter, a.id_dokter2, a.id_petugas, a.id_ruang, a.validasi FROM periksa a LEFT JOIN pasien b ON a.id_pasien=b.id WHERE MONTH(a.tanggal) = '$bulan' AND YEAR(a.tanggal) = '$tahun' AND a.state = '1' AND a.validasi = '0' ORDER BY a.nomor DESC";
            }

            $model = Yii::app()->db->createCommand($sql)->queryAll();

            $respon = array();

            foreach ($model as $data) {
                $d['id'] = $data['id'];
                $d['nomor'] = $data['nomor'];
                $d['tanggal'] = date("d-m-Y", strtotime($data['tanggal']));
                $d['no_rm'] = $data['no_rm'];
                $d['nama_pasien'] = $data['nama'];
                $d['dokter_pengirim'] = Dokter::item($data['id_dokter']);
                $d['dokter_pj'] = Dokter::item($data['id_dokter2']);
                $d['petugas'] = Petugas::item($data['id_petugas']);
                $d['ruangan'] = Ruang::item($data['id_ruang']);
                $d['validasi'] = $data['validasi'];

                array_push($respon, $d);
            }
        } else {
            $respon = array(
                "status" => "gagal",
                "message" => "Error Methods",
            );
        }

        echo json_encode($respon);
    }

    public function actionPvalidasi()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $model = Periksa::model()->findByAttributes(array(
                'nomor' => $_POST['nomor'],
            ));

            $model->validasi = '1';
            $model->tgl_validasi = date("Y:m:d H:i:s");
            $model->validasi_by = $_POST['nama'] . '-ANDROID';
            if ($model->save(false)) {
                $respon = array(
                    "status" => "sukses",
                    "message" => "Validasi berhasil",
                );
            } else {
                $respon = array(
                    "status" => "gagal",
                    "message" => "Validasi gagal",
                );
            }
        } else {
            $respon = array(
                "status" => "gagal",
                "message" => "Error Methods",
            );
        }

        echo json_encode($respon);
    }
    // Proses Validasi

    // Proses Selesai
    public function actionSelesai()
    {
        if ($_SERVER["REQUEST_METHOD"] == "GET") {
            $tahun = date('Y');
            $bulan = date("m");
            $idDokter = isset($_GET['id']) ? $_GET['id'] : '0';

            if($idDokter !=0) {
                $sql = "SELECT a.id, a.nomor, a.tanggal, b.no_rm, b.nama, a.id_dokter, a.id_dokter2, a.id_petugas, a.id_ruang, a.validasi FROM periksa a LEFT JOIN pasien b ON a.id_pasien=b.id WHERE MONTH(a.tanggal) = '$bulan' AND YEAR(a.tanggal) = '$tahun' AND a.state = '1' AND a.validasi = '1'  AND a.id_dokter2 = '$idDokter' ORDER BY a.nomor DESC LIMIT 50";
            } else {
                $sql = "SELECT a.id, a.nomor, a.tanggal, b.no_rm, b.nama, a.id_dokter, a.id_dokter2, a.id_petugas, a.id_ruang, a.validasi FROM periksa a LEFT JOIN pasien b ON a.id_pasien=b.id WHERE MONTH(a.tanggal) = '$bulan' AND YEAR(a.tanggal) = '$tahun' AND a.state = '1' AND a.validasi = '1' ORDER BY a.nomor DESC LIMIT 50";
            }
            
            $model = Yii::app()->db->createCommand($sql)->queryAll();

            $respon = array();

            foreach ($model as $data) {
                $d['id'] = $data['id'];
                $d['nomor'] = $data['nomor'];
                $d['tanggal'] = date("d-m-Y", strtotime($data['tanggal']));
                $d['no_rm'] = $data['no_rm'];
                $d['nama_pasien'] = $data['nama'];
                $d['dokter_pengirim'] = Dokter::item($data['id_dokter']);
                $d['dokter_pj'] = Dokter::item($data['id_dokter2']);
                $d['petugas'] = Petugas::item($data['id_petugas']);
                $d['ruangan'] = Ruang::item($data['id_ruang']);
                $d['validasi'] = $data['validasi'];
                $d['pcr'] = Result::jumlahPeriksa($data['nomor'], 'PCR');

                array_push($respon, $d);
            }
        } else {
            $respon = array(
                "status" => "gagal",
                "message" => "Error Methods",
            );
        }

        echo json_encode($respon);
    }
    // Proses Selesai

    // Proses Cari Selesai
    public function actionCariSelesai()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $cari = isset($_POST['cari']) ? $_POST['cari'] : 'XXX';
            $idDokter = isset($_POST['id_dokter']) ? $_POST['id_dokter'] : '0';

            if($idDokter !=0) {
                $sql = "SELECT a.id, a.nomor, a.tanggal, b.no_rm, b.nama, a.id_dokter, a.id_dokter2, a.id_petugas, a.id_ruang, a.validasi FROM periksa a LEFT JOIN pasien b ON a.id_pasien=b.id WHERE a.state = '1' AND a.validasi = '1' AND id_dokter2 = '$idDokter' AND (b.nama LIKE '%$cari%' OR b.no_rm LIKE '%$cari%') ORDER BY a.nomor DESC  LIMIT 100";
            } else {
                $sql = "SELECT a.id, a.nomor, a.tanggal, b.no_rm, b.nama, a.id_dokter, a.id_dokter2, a.id_petugas, a.id_ruang, a.validasi FROM periksa a LEFT JOIN pasien b ON a.id_pasien=b.id WHERE a.state = '1' AND a.validasi = '1' AND (b.nama LIKE '%$cari%' OR b.no_rm LIKE '%$cari%') ORDER BY a.nomor DESC  LIMIT 100";
            }

           
            $model = Yii::app()->db->createCommand($sql)->queryAll();

            $respon = array();

            foreach ($model as $data) {
                $d['id'] = $data['id'];
                $d['nomor'] = $data['nomor'];
                $d['tanggal'] = date("d-m-Y", strtotime($data['tanggal']));
                $d['no_rm'] = $data['no_rm'];
                $d['nama_pasien'] = $data['nama'];
                $d['dokter_pengirim'] = Dokter::item($data['id_dokter']);
                $d['dokter_pj'] = Dokter::item($data['id_dokter2']);
                $d['petugas'] = Petugas::item($data['id_petugas']);
                $d['ruangan'] = Ruang::item($data['id_ruang']);
                $d['validasi'] = $data['validasi'];
                $d['pcr'] = Result::jumlahPeriksa($data['nomor'], 'PCR');

                array_push($respon, $d);
            }
        } else {
            $respon = array(
                "status" => "gagal",
                "message" => "Error Methods",
            );
        }

        echo json_encode($respon);
    }
    // Proses Cari Selesai

    // Detail Pemeriksaan
    public function actionHasil($id)
    {
        $model = Periksa::model()->findByAttributes(array(
            'nomor' => $id,
            'state' => 1
        ));

        $umur = Pasien::umur($model->idPasien->tgl_lahir);
        $aumur = explode(",", $umur);
        $waktu =  count($aumur);

        if ($_SERVER["REQUEST_METHOD"] == "GET") {
            $respon = array();

            $sql = "SELECT b.nama, a.Nilai, a.keterangan, b.satuan, b.metoda, a.KodeParamater, a.acc, a.id, b.parameter, b.pembulatan
			FROM result a LEFT JOIN kode b ON a.KodeParamater=b.lis WHERE a.KodePatient='$id' AND a.acc='1' ORDER BY b.order";
            $detail = Yii::app()->db->createCommand($sql)->queryAll();

            foreach ($detail as $data) {
                if ($data['pembulatan'] == 0) {
                    $nilai = round($data['Nilai']);
                } else if ($data['pembulatan'] == 99) {
                    $nilai = $data['Nilai'];
                } else {
                    $nilai = round($data['Nilai'], $data['pembulatan']);
                }

                array_push($respon, array(
                    'pemeriksaan' => $data['nama'],
                    'nilai' => "" . $nilai,
                    'flag' => VKode::getFlag($data['KodeParamater'], $data['parameter'], $waktu, $model->idPasien->gender, $nilai),
                    'nilai_rujukan' => VKode::getField($data['KodeParamater'], $data['parameter'], $waktu, $model->idPasien->gender, 'nr'),
                    'satuan' => $data['satuan'],
                    'keterangan' => $data['keterangan']
                ));
            }
        } else {
            $respon = array(
                "status" => "gagal",
                "message" => "Error Methods",
            );
        }

        echo json_encode($respon);
    }
    // Detail Pemeriksaan
}
