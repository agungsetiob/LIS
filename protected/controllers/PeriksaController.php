<?php
class PeriksaController extends Controller
{
	public $layout = '//layouts/main';

	public function filters()
	{
		return array(
			'rights',
		);
	}

	public function allowedActions()
	{
		return 'cetakno';
	}

	public function actionIndex()
	{
		$model = new Periksa;
		$model->tanggal = date("d-m-Y");
		$model->nomor = "xxxxxxxxxx";

		$periksa = new Periksa('search');
		$periksa->unsetAttributes();
		if (isset($_GET['Periksa']))
			$periksa->attributes = $_GET['Periksa'];

		$pasien = new Pasien('search');
		$pasien->unsetAttributes();
		if (isset($_GET['Pasien']))
			$pasien->attributes = $_GET['Pasien'];


		if (isset($_POST['Periksa'])) {
			$model->attributes = $_POST['Periksa'];

			$model->seq = Periksa::getSeq();
			$model->nomor = date("ymd") . '' . $model->seq;
			$model->tanggal = date("Y:m:d H:i:s");
			$model->unit = Yii::app()->user->unit;
			$model->create_by = Yii::app()->user->nama;
			$model->create_at = date("Y:m:d H:i:s");
			if ($model->save()) {
				$this->redirect(array('view', 'id' => $model->id));
			}
		}

		$this->render('create', array(
			'model' => $model,
			'periksa' => $periksa,
			'pasien' => $pasien,
		));
	}

	public function actionView($id)
	{
		$modelResult = new VResult('search');
		$modelResult->unsetAttributes();
		if (isset($_GET['VResult']))
			$modelResult->attributes = $_GET['VResult'];

		$model = $this->loadModel($id);

		$sql = "SELECT b.nama, a.Nilai, b.satuan, b.metoda, a.KodeParamater, a.KodeAlat, a.acc, a.id, b.parameter, b.pembulatan FROM result a LEFT JOIN kode b ON a.KodeParamater=b.lis WHERE a.KodePatient='$model->nomor'";
		$detail = Yii::app()->db->createCommand($sql)->queryAll();
		$jumlah = count($detail);

		$modelKode = Kode::model()->findAll(array('order' => 'grup1'));
		$modelPeriksa = Paket::model()->findAll();

		$this->render('view', array(
			'model' => $model,
			'detail' => $detail,
			'jumlah' => $jumlah,
			'modelKode' => $modelKode,
			'modelPeriksa' => $modelPeriksa,
			'modelResult' => $modelResult,
		));
	}

	public function actionSelesai()
	{
		$id = $_POST['id'];
		$model = $this->loadModel($id);
		$model->state = '1';
		$model->validasi = '1';
		$model->selesai = date("Y:m:d H:i:s");
		$model->tgl_validasi = date("Y:m:d H:i:s");
		$model->update_by = Yii::app()->user->nama;
		$model->update_at = date("Y:m:d H:i:s");
		$model->save();
	}

	public function actionUpdate()
	{
		$id = $_POST['id'];
		$model = $this->loadModel($id);
		$model->update_by = Yii::app()->user->nama;
		$model->update_at = date("Y:m:d H:i:s");
		if ($_POST['field'] == 'note') {
			$model->note = $_POST['note'];
		}
		if ($_POST['field'] == 'ket_klinik') {
			$model->ket_klinik = $_POST['ket_klinik'];
		}
		if ($_POST['field'] == 'id_ruang') {
			$model->id_ruang = $_POST['id_ruang'];
		}
		if ($_POST['field'] == 'id_petugas') {
			$model->id_petugas = $_POST['id_petugas'];
		}
		if ($_POST['field'] == 'id_dokter') {
			$model->id_dokter = $_POST['id_dokter'];
		}
		if ($_POST['field'] == 'id_dokter2') {
			$model->id_dokter2 = $_POST['id_dokter2'];
		}
		if ($_POST['field'] == 'id_verifikasi') {
			$model->id_verifikasi = $_POST['id_verifikasi'];
		}
		if ($_POST['field'] == 'penjamin') {
			$model->id_penjamin = $_POST['penjamin'];
		}
		if ($_POST['field'] == 'tgl_distribusi') {
			$model->tgl_distribusi = $_POST['tgl_distribusi'];
		}
		if ($_POST['field'] == 'id_jenis') {
			$model->id_jenis = $_POST['id_jenis'];
		}
		if ($_POST['field'] == 'ket_verifikasi') {
			$model->ket_verifikasi = $_POST['ket_verifikasi'];
		}
		if ($model->save()) {
			echo "sukses";
		}
	}

	public function actionHasil()
	{
		$model = new Periksa('search');
		$model->unsetAttributes();
		if (isset($_GET['Periksa']))
			$model->attributes = $_GET['Periksa'];

		$this->render('hasil', array(
			'model' => $model,
		));
	}

	public function actionPending()
	{
		$model = new Periksa('search');
		$model->unsetAttributes();
		if (isset($_GET['Periksa']))
			$model->attributes = $_GET['Periksa'];

		$this->render('pending', array(
			'model' => $model,
		));
	}

	public function actionCetak($id)
	{
		$model = Periksa::model()->findByPk($id);
		$model->kode = md5($model->id);
		$model->cetak = 1;
		$model->save(false);

		$this->generateQroCode($id);

		$log = new Log;
		$log->id_user = Yii::app()->user->id;
		$log->kode = $model->nomor;
		$log->keterangan = 'Cetak Pemeriksaan - ' . Petugas::item($model->id_petugas);
		$log->tanggal = date("Y-m-d H:i:s");
		$log->ip = Yii::app()->request->getUserHostAddress();
		$log->save();

		$pdf = new CetakHasil('P', 'cm', 'A4', $id);
		$pdf->AddPage();
		$pdf->SetMargins(0.5, 0.5, 0.5);
		$pdf->AliasNbPages();
		$pdf->Report($id);
		$pdf->Output($model->idPasien->nama . '_' .  date("d-m-Y", strtotime($model->tanggal)) . '.pdf', 'I');
	}

	public function actionCetakNo($no)
	{
		$model = Periksa::model()->findByAttributes(array(
			'nomor' => $no,
		));

		$this->generateQroCode($model->id);

		$pdf = new CetakHasil('P', 'cm', array(21.6, 35.6), $model->id);
		$pdf->AddPage();
		$pdf->SetMargins(0.5, 0.5, 0.5);
		$pdf->AliasNbPages();
		$pdf->Report($model->id);
		$pdf->Output($model->idPasien->nama . '_' .  date("d-m-Y", strtotime($model->tanggal)) . '.pdf', 'I');
	}

	public function actionCetakGdt($id)
	{
		$model = Periksa::model()->findByPk($id);
		$model->kode = md5($model->id);
		$model->cetak = 1;
		$model->save(false);

		$this->generateQroCode($id);

		$pdf = new CetakHasilGdt('P', 'cm', 'A4', $id);
		$pdf->AddPage();
		$pdf->SetMargins(0.5, 0.5, 0.5);
		$pdf->AliasNbPages();
		$pdf->Report($id);
		$pdf->Output($model->idPasien->nama . '_' .  date("d-m-Y", strtotime($model->tanggal)) . '.pdf', 'I');
	}

	public function actionCetakPcr($id)
	{
		$model = Periksa::model()->findByPk($id);
		$model->kode = md5($model->id);
		$model->cetak = 1;
		$model->save(false);

		$pdf = new CetakHasilPcr('P', 'cm', 'A4', $id);
		$pdf->AddPage();
		$pdf->SetMargins(0.5, 0.5, 0.5);
		$pdf->AliasNbPages();
		$pdf->Report($id);
		$pdf->Output($model->idPasien->nama . '_' .  date("d-m-Y", strtotime($model->tanggal)) . '.pdf', 'I');
	}

	public function actionSuratPcr($id)
	{
		$model = Periksa::model()->findByPk($id);
		$model->kode = md5($model->id);
		$model->cetak = 1;
		$model->save(false);

		$pdf = new CetakSuratPcr('P', 'cm', 'A4', $id);
		$pdf->AddPage();
		$pdf->SetMargins(0.5, 0.5, 0.5);
		$pdf->AliasNbPages();
		$pdf->Report($id);
		$pdf->Output($model->idPasien->nama . '_' .  date("d-m-Y", strtotime($model->tanggal)) . '.pdf', 'I');
	}

	public function actionCetakCovid($id)
	{
		$model = Periksa::model()->findByPk($id);
		$model->kode = md5($model->id);
		$model->cetak = 1;
		$model->save(false);

		$this->generateQroCode($id);

		$pdf = new CetakHasilCovid('P', 'cm', 'A4', $id);
		$pdf->AddPage();
		$pdf->SetMargins(0.5, 0.5, 0.5);
		$pdf->AliasNbPages();
		$pdf->Report($id);
		$pdf->Output($model->idPasien->nama . '_' .  date("d-m-Y", strtotime($model->tanggal)) . '.pdf', 'I');
	}

	public function actionCpending()
	{
		$pdf = new CetakPeriksaPending('P', 'cm', array(21, 35.6));
		$pdf->SetMargins(0.5, 0.5, 0.5);
		$pdf->SetAutoPageBreak(false, 0.1);
		$pdf->AliasNbPages();
		$pdf->AddPage();
		$pdf->Report();
		$pdf->Output();
	}

	public function actionDelete($id)
	{
		if (Yii::app()->request->isPostRequest) {
			// we only allow deletion via POST request
			$this->loadModel($id)->delete();

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if (!isset($_GET['ajax']))
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
		} else
			throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');
	}

	public function loadModel($id)
	{
		$model = Periksa::model()->findByPk($id);
		if ($model === null)
			throw new CHttpException(404, 'The requested page does not exist.');
		return $model;
	}

	public function actionBarcode($id)
	{
		$pdf = new CetakBarcode('L', 'cm', array(2.2, 5.5), $id);
		$pdf->SetMargins(0, 0, 0);
		$pdf->SetAutoPageBreak(false, 0.1);
		$pdf->AddPage();
		$pdf->Report($id);
		$pdf->Output();
	}

	public function actionManual($id)
	{
		$model = explode(",", $_POST['kode']);
		foreach ($model as $data) {
			$model = new Result;
			$model->KodePatient = $id;
			$model->KodeAlat = '-';
			$model->KodeParamater = Kode::getLis($data);
			$model->tanggal = date("Y-m-d H:i:s");
			$model->save(false);
		}
		echo "sukses";
	}

	public function actionPaket($id)
	{
		$model = explode(",", $_POST['kode']);
		foreach ($model as $data) {

			$modelKode = PaketDetail::model()->findAll(array('condition' => 'id_paket=:id', 'params' => array(':id' => $data)));

			foreach ($modelKode as $dataKode) {
				$result = new Result;
				$result->PatientName = '-';
				$result->KodePatient = $id;
				$result->KodeAlat = '-';
				$result->KodeParamater = Kode::getField($dataKode->id_kode, 'lis');
				$result->tanggal = date("Y-m-d H:i:s");
				$result->save(false);
			}
		}
		echo "sukses";
	}

	public function actionFormula($id)
	{
		$model = explode(",", $_POST['kode']);
		foreach ($model as $data) {

			$formula = Formula::model()->findByPk($data);

			$modelKode = Kode::model()->findAll(array('condition' => 'formula=:id', 'params' => array(':id' => $formula->lis)));

			foreach ($modelKode as $dataKode) {
				$result = new Result;
				$result->KodePatient = $id;
				$result->KodeAlat = '-';
				$result->KodeParamater = $dataKode->lis;
				$result->save(false);
			}
		}
		echo "sukses";
	}

	public function generateQroCode($id)
	{
		include 'protected/extensions/phpqrcode/qrlib.php';

		$model = $this->loadModel($id);

		$qr = Yii::app()->params['qr_link'] . '' . $model->nomor;
		QRcode::png($qr, "qrcode/" . $model->nomor . ".png", "L", 4, 4);
	}


	// BIAYA
	public function actionBiaya()
	{
		$model = new Periksa('search');
		$model->unsetAttributes();  // clear any default values
		if (isset($_GET['Periksa']))
			$model->attributes = $_GET['Periksa'];

		$this->render('biaya', array(
			'model' => $model,
		));
	}

	public function actionVbiaya($id)
	{
		$model = $this->loadModel($id);

		$modelTarif = Tarif::model()->findAll();

		$modelBiaya = PeriksaBiaya::model()->findAll('periksa_id = ' . $_GET['id']);

		$this->render('vbiaya', array(
			'model' => $model,
			'modelTarif' => $modelTarif,
			'modelBiaya' => $modelBiaya,
		));
	}

	public function actionTarif($id)
	{
		$model = explode(",", $_POST['kode']);
		foreach ($model as $data) {
			$model = new PeriksaBiaya;
			$model->periksa_id = $id;
			$model->tarif_id = $data;
			$model->tarif = Tarif::getBiaya($data);
			$model->save(false);
		}
		echo "sukses";
	}

	public function actionBdelete()
	{
		$model = PeriksaBiaya::model()->findByPk($_POST['id']);
		$model->delete();
	}

	public function actionCetakBiaya($id)
	{
		$model = $this->loadModel($id);
		$model->total = $_GET['t'];
		$model->save();

		$pdf = new CetakBiaya('P', 'cm', array(10.8, 16.5), $id);
		$pdf->AddPage();
		$pdf->SetMargins(0.5, 0.5, 0.5);
		$pdf->Report($id);
		$pdf->Output();
	}
	// BIAYA

	public function actionAlat($id, $nomor, $sampel, $tanggal)
	{
		$sql = "SELECT id, KodePatient, KodeAlat, KodeParamater, Nilai FROM result WHERE KodePatient = '$sampel'";
		$model = Yii::app()->db->createCommand($sql)->queryAll();

		foreach ($model as $data) {
			$result = Result::model()->findByPk($data['id']);
			$result->sampel = $data['KodePatient'];
			$result->KodePatient = $nomor;
			$result->save(false);
		}

		$this->redirect(array('view', 'id' => $id));
	}

	public function actionPasien()
	{
		$id = $_POST['no_rm'];

		$link = "http://localhost:8000/api/pasien.php?id=$id";

		$api = Yii::app()->curl->get($link);

		$data0 = CJSON::decode($api);

		$spasien = "SELECT COUNT(*) AS jumlah FROM pasien WHERE no_rm='$id'";
		$dpasien = Yii::app()->db->createCommand($spasien)->queryRow();

		if ($dpasien['jumlah'] == 0) {
			$pasien = new Pasien;
			$pasien->no_rm = $data0['no_rm'];
			$pasien->nama = $data0['nama'];
			$pasien->tempat_lahir = $data0['tempat_lahir'];
			$pasien->tgl_lahir = date("d-m-Y", strtotime($data0['tgl_lahir']));
			$pasien->gender = $data0['gender'];
			$pasien->alamat = $data0['alamat'];
			$pasien->state  = 1;
			$pasien->id_instansi = 0;
		} else {
			$pasien = Pasien::model()->findByAttributes(array('no_rm' => $data0['no_rm']));
			$pasien->no_rm = $data0['no_rm'];
			$pasien->nama = $data0['nama'];
			$pasien->tempat_lahir = $data0['tempat_lahir'];
			$pasien->tgl_lahir = date("d-m-Y", strtotime($data0['tgl_lahir']));
			$pasien->gender = $data0['gender'];
			$pasien->alamat = $data0['alamat'];
			$pasien->state  = 1;
			$pasien->id_instansi = 0;
		}

		if ($pasien->save()) {
			$respon = array(
				"status" => "sukses",
				"id" => $pasien->id,
				"nama" => $pasien->nama,
			);
		} else {
			$respon = array(
				"status" => "gagal",
			);
		}

		echo json_encode($respon);
	}
}
