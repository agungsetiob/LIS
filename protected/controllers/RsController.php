<?php

class RsController extends Controller
{
    public $layout = '//layouts/main';

    public $BASE_URL = 'http://localhost:8000/api/';

    public function actionIndex()
    {
        $respon = array(
            "status" => "sukses",
            "app_name" => "API SimRS",
        );

        echo json_encode($respon);
    }

    public function actionPeriksa()
    {
        $tgl = isset($_GET['tgl']) ? $_GET['tgl'] : date("Y-m-d");

        $link = $this->BASE_URL . "daftar.php?tgl=$tgl";

        $api = Yii::app()->curl->get($link);

        $data = CJSON::decode($api);

        $this->render('periksa', array(
            'data' => $data,
            'tgl' => $tgl,
        ));
    }

    public function actionTolis($id)
    {
        $link = $this->BASE_URL . "detail.php?id=$id";

        $api = Yii::app()->curl->get($link);

        $data = CJSON::decode($api);

        $this->dataTerima($data);
    }

    public function dataTerima($data)
    {
        $data0 = $data;
        $nolab = $data['NOMOR'];

        // Pasien
        $spasien = "SELECT COUNT(*) AS jumlah FROM pasien WHERE no_rm='$data0[NORM]'";
        $dpasien = Yii::app()->db->createCommand($spasien)->queryRow();

        if ($dpasien['jumlah'] == 0) {
            $pasien = new Pasien;
            $pasien->no_rm = $data0['NORM'];
            $pasien->nama = $data0['NAMA'];
            $pasien->tempat_lahir = $data0['TEMPAT_LAHIR'];
            $pasien->tgl_lahir = date("d-m-Y", strtotime($data0['TANGGAL_LAHIR']));
            $pasien->gender = $data0['JENIS_KELAMIN'];
            $pasien->alamat = $data0['ALAMAT'];
            $pasien->state  = 1;
            $pasien->id_instansi = 0;
            echo ($pasien->save()) ? "create pasien sukses<br>" : print_r($pasien->getErrors());
        } else {
            if ($data0['NORM'] == '') {
                $pasien = new Pasien;
                $pasien->no_rm = $data0['NORM'];
                $pasien->nama = $data0['NAMA'];
                $pasien->tempat_lahir = $data0['TEMPAT_LAHIR'];
                $pasien->tgl_lahir = date("d-m-Y", strtotime($data0['TANGGAL_LAHIR']));
                $pasien->gender = $data0['JENIS_KELAMIN'];
                $pasien->alamat = $data0['ALAMAT'];
                $pasien->state  = 1;
                $pasien->id_instansi = 0;
                echo ($pasien->save()) ? "create pasien sukses<br>" : print_r($pasien->getErrors());
            } else {
                $pasien = Pasien::model()->findByAttributes(array('no_rm' => $data0['NORM']));
                $pasien->no_rm = $data0['NORM'];
                $pasien->nama = $data0['NAMA'];
                $pasien->tempat_lahir = $data0['TEMPAT_LAHIR'];
                $pasien->tgl_lahir = date("d-m-Y", strtotime($data0['TANGGAL_LAHIR']));
                $pasien->gender = $data0['JENIS_KELAMIN'];
                $pasien->alamat = $data0['ALAMAT'];
                $pasien->state  = 1;
                $pasien->id_instansi = 0;
                echo ($pasien->save()) ? "update pasien sukses<br>" : print_r($pasien->getErrors());
            }
        }
        // Pasien

        // Dokter Pengirim
        $sdokter1 = "SELECT COUNT(*) AS jumlah FROM dokter WHERE id_dokter='$data0[KODE_DOKTER]'";
        $ddokter1 = Yii::app()->db->createCommand($sdokter1)->queryRow();

        if ($ddokter1['jumlah'] == 0) {
            $dokter1 = new Dokter;
            $dokter1->id_dokter = $data0['KODE_DOKTER'];
            $dokter1->nama = $data0['NAMA_DOKTER'];
            $dokter1->kode = 1;
            echo ($dokter1->save()) ? "create dokter pj sukses<br>" : print_r($pasien->getErrors());
        } else {
            $dokter1 = Dokter::model()->findByAttributes(array('id_dokter' => $data0['KODE_DOKTER']));
            $dokter1->id_dokter = $data0['KODE_DOKTER'];
            $dokter1->nama = $data0['NAMA_DOKTER'];
            $dokter1->kode = 1;
            echo ($dokter1->save()) ? "update dokter pj sukses<br>" : print_r($pasien->getErrors());
        }
        // Dokter Pengirim

        // Poliklinik
        $spoli = "SELECT COUNT(*) AS jumlah FROM ruang WHERE poli_id='$data0[KODE_RUANGAN]'";
        $dpoli = Yii::app()->db->createCommand($spoli)->queryRow();

        if ($dpoli['jumlah'] == 0) {
            $ruang = new Ruang;
            $ruang->poli_id = $data0['KODE_RUANGAN'];
            $ruang->nama = $data0['NAMA_RUANGAN'];
            echo ($ruang->save()) ? "create ruang sukses<br>" : print_r($pasien->getErrors());
        } else {
            $ruang = Ruang::model()->findByAttributes(array('poli_id' => $data0['KODE_RUANGAN']));
            $ruang->poli_id = $data0['KODE_RUANGAN'];
            $ruang->nama = $data0['NAMA_RUANGAN'];
            echo ($ruang->save()) ? "update ruang sukses<br>" : print_r($pasien->getErrors());
        }
        // Poliklinik

        // Periksa
        $speriksa = "SELECT COUNT(*) AS jumlah FROM periksa WHERE no_reg='$nolab'";
        $dperiksa = Yii::app()->db->createCommand($speriksa)->queryRow();

        if ($dperiksa['jumlah'] == 0) {
            $periksa = new Periksa;
            $periksa->tanggal = date("Y-m-d H:i:s");
            $periksa->seq = Periksa::getSeq();
            $periksa->nomor = date("ymd") . '' . $periksa->seq;
            $periksa->no_reg = $nolab;
            $periksa->id_pasien = $pasien->id;
            $periksa->id_dokter = $dokter1->id;
            $periksa->id_dokter2 = 1;
            $periksa->id_ruang = $ruang->id;
            if (Yii::app()->user->id_petugas != 0) {
                $periksa->id_petugas = Yii::app()->user->id_petugas;
            } else {
                $periksa->id_petugas = 1;
            }
            $periksa->unit = Yii::app()->user->unit;
            $periksa->create_by = Yii::app()->user->nama;
            $periksa->create_at = date("Y:m:d H:i:s");
            $periksa->save();
        } else {
            $periksa = Periksa::model()->findByAttributes(array('no_reg' => $nolab));
        }

        $this->dataTerimaDetail($data0);

        $this->redirect(array('periksa/view', 'id' => $periksa->id));
    }

    public function dataTerimaDetail($data)
    {
        $query = '';
        $jumlah = count($data['PEMERIKSAAN']);
        if ($jumlah != 0) {
            $query = "INSERT INTO periksa_simrs VALUES";

            foreach ($data['PEMERIKSAAN'] as $d) {
                $query .= "(0,'" . $data['NOMOR'] . "','-','" . $d['KODE'] . "','" . $d['TINDAKAN'] . "'),";
            }

            $query = substr($query, 0, strlen($query) - 1) . ";";

            $scek = "SELECT COUNT(*) AS jumlah FROM periksa_simrs WHERE no_lab = '$data[no_lab]'";
            $dcek = Yii::app()->db->createCommand($scek)->queryRow();

            if ($dcek['jumlah'] == 0) {
                Yii::app()->db->createCommand($query)->execute();
            }
        }
    }

    //POST KE SIMRS
    public function dataKirim($no)
    {
        $model = Periksa::model()->findByAttributes(array(
            'nomor' => $no,
            'state' => 1
        ));

        $waktu = VPasien::getField($model->id_pasien, 'umur');

        $sql = "SELECT a.Nilai, a.KodeParamater, b.parameter, b.pembulatan
        FROM result a LEFT JOIN kode b ON a.KodeParamater=b.lis WHERE a.KodePatient='$no' AND a.acc='1' ORDER BY b.order";
        $detail = Yii::app()->db->createCommand($sql)->queryAll();

        $json = array();
        $hasil = array();

        $json['no_lis'] = $model->nomor;
        $json['no_lab'] = $model->no_reg;
        $json['link_hasil'] = Yii::app()->params['cetak_link'] . '' . $model->nomor;

        foreach ($detail as $data) {
            if ($data['pembulatan'] == 0) {
                $nilai = round($data['Nilai']);
            } else if ($data['pembulatan'] == 99) {
                $nilai = $data['Nilai'];
            } else {
                $nilai = round($data['Nilai'], $data['pembulatan']);
            }

            array_push($hasil, array(
                'grup' => PeriksaSimrsDetail::getField($model->no_reg, $data['KodeParamater'], 'grup'),
                'kode' => PeriksaSimrsDetail::getField($model->no_reg, $data['KodeParamater'], 'kode'),
                'lis' => $data['KodeParamater'],
                'nilai' => (string) $nilai,
                'nilai_rujukan' => VKode::getField($data['KodeParamater'], $data['parameter'], $waktu, $model->idPasien->gender, 'nr'),
            ));
        }

        $json['data'] = $hasil;

        $dataHasil = CJSON::encode($json);

        return $dataHasil;
    }

    public function actionCekKirim($no = "")
    {
        $dataKirim = $this->dataKirim($no);

        print_r($dataKirim);
    }

    public function actionKirim($no = "")
    {
        $model = Periksa::model()->findByAttributes(array(
            'nomor' => $no,
            'state' => 1
        ));

        $link = $this->BASE_URL . "post.php";

        $dataKirim = $this->dataKirim($no);

        $api = Yii::app()->curl->post($link, $dataKirim);

        $this->redirect(array('periksa/cetak', 'id' => $model->id));
    }
    //POST KE SIMRS
}
