<?php

class LaporanController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout = '//layouts/main';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'rights', // perform access control for CRUD operations
		);
	}

	public function actionPasien0()
	{
		$model = new LaporanPeriodePenjamin;
		$model->awal = date("01-m-Y");
		$model->akhir = date("d-m-Y");

		if (isset($_POST['LaporanPeriodePenjamin'])) {
			$model->attributes = $_POST['LaporanPeriodePenjamin'];
			if ($model->validate()) {
				$pdf = new CetakPasien0('L', 'mm', array(216, 356), $model->awal, $model->akhir, $model->penjamin);
				$pdf->SetMargins(5, 5, 5);
				$pdf->AliasNbPages();
				$pdf->AddPage();
				$pdf->Report($model->awal, $model->akhir, $model->penjamin);
				$pdf->Output();
			}
		}

		$this->render('pasien0', array('model' => $model));
	}

	public function actionPasien()
	{
		$model = new LaporanPeriode;
		$model->awal = date("01-m-Y");
		$model->akhir = date("d-m-Y");

		if (isset($_POST['LaporanPeriode'])) {
			$model->attributes = $_POST['LaporanPeriode'];
			if ($model->validate()) {
				// $pdf=new CetakPasien('L','mm','A4',$model->awal,$model->akhir);
				$pdf = new CetakPasien('L', 'mm', array(210, 330), $model->awal, $model->akhir);
				$pdf->SetMargins(5, 5, 5);
				$pdf->AliasNbPages();
				$pdf->AddPage();
				$pdf->Report($model->awal, $model->akhir);
				$pdf->Output();
			}
		}

		$this->render('pasien', array('model' => $model));
	}

	public function actionPasien1()
	{
		$model = new LaporanMcu;
		$model->awal = date("01-m-Y");
		$model->akhir = date("d-m-Y");

		if (isset($_POST['LaporanMcu'])) {
			$model->attributes = $_POST['LaporanMcu'];
			if ($model->validate()) {
				$pdf = new CetakPasien1('L', 'cm', array(21, 33), $model->awal, $model->akhir, $model->instansi);
				$pdf->SetMargins(0.5, 0.5, 0.5);
				$pdf->AliasNbPages();
				$pdf->AddPage();
				$pdf->Report($model->awal, $model->akhir, $model->instansi);
				$pdf->Output();
			}
		}

		$this->render('pasien1', array('model' => $model));
	}

	public function actionPasien2()
	{
		$model = new LaporanPeriode;
		$model->awal = date("01-m-Y");
		$model->akhir = date("d-m-Y");

		if (isset($_POST['LaporanPeriode'])) {
			$model->attributes = $_POST['LaporanPeriode'];
			if ($model->validate()) {
				$pdf = new CetakPasien2('L', 'mm', array(210, 330), $model->awal, $model->akhir);
				$pdf->SetMargins(5, 5, 5);
				$pdf->AliasNbPages();
				$pdf->AddPage();
				$pdf->Report($model->awal, $model->akhir);
				$pdf->Output();
			}
		}

		$this->render('pasien2', array('model' => $model));
	}

	public function actionPasien3()
	{
		$model = new LaporanPeriode;
		$model->awal = date("01-m-Y");
		$model->akhir = date("d-m-Y");

		if (isset($_POST['LaporanPeriode'])) {
			$model->attributes = $_POST['LaporanPeriode'];
			if ($model->validate()) {
				$pdf = new CetakPasien3('L', 'mm', array(210, 330), $model->awal, $model->akhir);
				$pdf->SetMargins(5, 5, 5);
				$pdf->AliasNbPages();
				$pdf->AddPage();
				$pdf->Report($model->awal, $model->akhir);
				$pdf->Output();
			}
		}

		$this->render('pasien3', array('model' => $model));
	}

	public function actionPasien4()
	{
		$model = new LaporanPeriode;
		$model->awal = date("01-m-Y");
		$model->akhir = date("d-m-Y");

		if (isset($_POST['LaporanPeriode'])) {
			$model->attributes = $_POST['LaporanPeriode'];
			if ($model->validate()) {
				$pdf = new CetakPasien4('L', 'cm', array(21, 33), $model->awal, $model->akhir);
				$pdf->SetMargins(0.5, 0.5, 0.5);
				$pdf->AliasNbPages();
				$pdf->AddPage();
				$pdf->Report($model->awal, $model->akhir);
				$pdf->Output();
			}
		}

		$this->render('pasien4', array('model' => $model));
	}

	public function actionPasien5()
	{
		$model = new LaporanPasien;
		$model->awal = date("01-m-Y");
		$model->akhir = date("d-m-Y");

		$pasien = new Pasien('search');
		$pasien->unsetAttributes();  // clear any default values
		if (isset($_GET['Pasien']))
			$pasien->attributes = $_GET['Pasien'];

		if (isset($_POST['LaporanPasien'])) {
			$model->attributes = $_POST['LaporanPasien'];
			if ($model->validate()) {
				$pdf = new CetakPasien5('L', 'cm', array(21.6, 35.6), $model->awal, $model->akhir, $model->pasien);
				$pdf->SetMargins(0.5, 0.5, 0.5);
				$pdf->AliasNbPages();
				$pdf->AddPage();
				$pdf->Report($model->awal, $model->akhir, $model->pasien);
				$pdf->Output();
			}
		}

		$this->render('pasien5', array('model' => $model, 'pasien' => $pasien));
	}

	public function actionRujukan()
	{
		$model = new LaporanRujukan;
		$model->awal = date("01-m-Y");
		$model->akhir = date("d-m-Y");

		if (isset($_POST['LaporanRujukan'])) {
			$model->attributes = $_POST['LaporanRujukan'];
			if ($model->validate()) {
				$pdf = new CetakRujukan('L', 'mm', array(216, 356), $model->awal, $model->akhir, $model->dokter);
				$pdf->SetMargins(5, 5, 5);
				$pdf->AliasNbPages();
				$pdf->AddPage();
				$pdf->Report($model->awal, $model->akhir, $model->dokter);
				$pdf->Output();
			}
		}

		$this->render('rujukan', array('model' => $model));
	}

	public function actionKode()
	{
		$model = new LaporanKode;
		$model->awal = date("01-m-Y");
		$model->akhir = date("d-m-Y");

		$kode = new Kode('search');
		$kode->unsetAttributes();  // clear any default values
		if (isset($_GET['Kode']))
			$kode->attributes = $_GET['Kode'];

		if (isset($_POST['LaporanKode'])) {
			$model->attributes = $_POST['LaporanKode'];
			if ($model->validate()) {
				$pdf = new CetakItem('L', 'mm', array(216, 356), $model->awal, $model->akhir, $model->kode);
				$pdf->SetMargins(5, 5, 5);
				$pdf->AliasNbPages();
				$pdf->AddPage();
				$pdf->Report($model->awal, $model->akhir, $model->kode);
				$pdf->Output();
			}
		}

		$this->render('kode', array('model' => $model, 'kode' => $kode));
	}

	public function actionOmzet()
	{
		$model = new LaporanPeriode;
		$model->awal = date("01-m-Y");
		$model->akhir = date("d-m-Y");

		if (isset($_POST['LaporanPeriode'])) {
			$model->attributes = $_POST['LaporanPeriode'];
			if ($model->validate()) {
				$pdf = new CetakOmzet('L', 'cm', array(21, 33), $model->awal, $model->akhir);
				$pdf->SetMargins(0.5, 0.5, 0.5);
				$pdf->AliasNbPages();
				$pdf->AddPage();
				$pdf->Report($model->awal, $model->akhir);
				$pdf->Output();
			}
		}

		$this->render('omzet', array('model' => $model));
	}

	public function actionLr()
	{
		$model = new LaporanBulanTahun;
		$model->bulan = date("n");
		$model->tahun = date("Y");

		if (isset($_POST['LaporanBulanTahun'])) {
			$model->attributes = $_POST['LaporanBulanTahun'];
			if ($model->validate()) {
				$pdf = new CetakLr('P', 'cm', 'A4', $model->bulan, $model->tahun);
				$pdf->SetMargins(0.5, 0.5, 0.5);
				$pdf->AliasNbPages();
				$pdf->AddPage();
				$pdf->Report($model->bulan, $model->tahun);
				$pdf->Output();
			}
		}

		$this->render('lr', array('model' => $model));
	}

	public function actionGrup()
	{
		$model = new LaporanGrup;
		$model->awal = date("01-m-Y");
		$model->akhir = date("d-m-Y");

		$kode = new Kode('search');
		$kode->unsetAttributes();  // clear any default values
		if (isset($_GET['Kode']))
			$kode->attributes = $_GET['Kode'];

		if (isset($_POST['LaporanGrup'])) {
			$model->attributes = $_POST['LaporanGrup'];
			if ($model->validate()) {
				if ($model->pilih == 1) {
					$grup = $model->grup1;
				} else if ($model->pilih == 2) {
					$grup = $model->grup2;
				} else if ($model->pilih == 3) {
					$grup = $model->grup3;
				}
				$pdf = new CetakGrup('L', 'mm', array(216, 356), $model->awal, $model->akhir, $grup, $model->pilih);
				$pdf->SetMargins(5, 5, 5);
				$pdf->AliasNbPages();
				$pdf->AddPage();
				$pdf->Report($model->awal, $model->akhir, $grup, $model->pilih);
				$pdf->Output();
			}
		}

		$this->render('grup', array('model' => $model, 'kode' => $kode));
	}

	public function actionKritis()
	{
		$model = new LaporanKode;
		$model->awal = date("01-m-Y");
		$model->akhir = date("d-m-Y");

		$kode = new Kode('search');
		$kode->unsetAttributes();  // clear any default values
		if (isset($_GET['Kode']))
			$kode->attributes = $_GET['Kode'];

		if (isset($_POST['LaporanKode'])) {
			$model->attributes = $_POST['LaporanKode'];
			if ($model->validate()) {
				$pdf = new CetakKritis('L', 'mm', array(216, 356), $model->awal, $model->akhir, $model->kode);
				$pdf->SetMargins(5, 5, 5);
				$pdf->AliasNbPages();
				$pdf->AddPage();
				$pdf->Report($model->awal, $model->akhir, $model->kode);
				$pdf->Output();
			}
		}

		$this->render('kritis', array('model' => $model, 'kode' => $kode));
	}

	public function actionRexcel($awal, $akhir, $penjamin)
	{
		$namaruang = ($penjamin == 0) ? "SEMUA" : strtoupper(Ruang::item($penjamin));
		$awal1 = Parameter::tglMySQL($awal);
		$akhir1 = Parameter::tglMySQL($akhir);

		Yii::import('ext.phpexcel.XPHPExcel');
		$object = XPHPExcel::createPHPExcel();
		$objReader = PHPExcel_IOFactory::createReader('Excel2007');
		$objPHPExcel = $objReader->load("excel/ruangan.xlsx");

		$ex = $objPHPExcel->setActiveSheetIndex(0);
		$ex->setCellValue('A6', "RUANGAN : " . $namaruang);
		$ex->setCellValue('A7', 'PERIODE : ' .  $awal . ' -' . $akhir);

		if ($penjamin == 0) {
			$sql = "SELECT a.nomor, a.tanggal, a.no_reg, b.nama, b.gender, b.tgl_lahir, a.id_dokter, a.id_dokter2, b.no_rm, b.alamat, a.id_petugas, d.nama AS parameter,  a.id_ruang FROM periksa a LEFT JOIN pasien b ON a.id_pasien=b.id LEFT JOIN result c ON a.nomor=c.KodePatient LEFT JOIN kode d ON c.KodeParamater=d.lis WHERE DATE(a.tanggal) BETWEEN '$awal1' AND '$akhir1' AND a.state='1' ORDER BY a.nomor";
		} else {
			$sql = "SELECT a.nomor, a.tanggal, a.no_reg, b.nama, b.gender, b.tgl_lahir, a.id_dokter, a.id_dokter2, b.no_rm, b.alamat, a.id_petugas, d.nama AS parameter FROM periksa a LEFT JOIN pasien b ON a.id_pasien=b.id LEFT JOIN result c ON a.nomor=c.KodePatient LEFT JOIN kode d ON c.KodeParamater=d.lis WHERE DATE(a.tanggal) BETWEEN '$awal1' AND '$akhir1' AND a.id_ruang='$ruang' AND a.state='1' ORDER BY a.nomor";
		}

		$model = Yii::app()->db->createCommand($sql)->queryAll();
		$no = 1;
		$counter = 9;
		foreach ($model as $data) {
			$ex->setCellValue("A" . $counter, $no);
			$ex->setCellValue("B" . $counter, $data['nomor']);
			$ex->setCellValue("C" . $counter, date("d-m-Y", strtotime($data['tanggal'])) . " " . date("H:i:s", strtotime($data['tanggal'])));
			$ex->setCellValue("D" . $counter, $data['nama']);
			$ex->setCellValue("E" . $counter, Parameter::getGender($data['gender']));
			$ex->setCellValue("F" . $counter, Pasien::umur2($data['tgl_lahir']));
			$ex->setCellValue("G" . $counter, Ruang::item($data['id_ruang']));
			$ex->setCellValue("H" . $counter, Dokter::item($data['id_dokter']));
			$ex->setCellValue("I" . $counter, Dokter::item($data['id_dokter2']));
			$ex->setCellValue("J" . $counter, Petugas::item($data['id_petugas']));
			$ex->setCellValue("K" . $counter, $data['parameter']);

			$no++;
			$counter++;
		}

		$styleArray = array(
			'borders' => array(
				'allborders' => array(
					'style' => PHPExcel_Style_Border::BORDER_THIN
				)
			)
		);

		$counter--;

		$objPHPExcel->getActiveSheet()->getStyle('A9:J' . $counter)->applyFromArray($styleArray);

		for ($col = 'A'; $col !== 'K'; $col++) {
			$objPHPExcel->getActiveSheet()
				->getColumnDimension($col)
				->setAutoSize(true);
		}

		header('Content-Disposition: attachment;filename="LAPORAN PEMERIKSAAN RUANGAN ' . $namaruang . ' ' . $awal . ' -' . $akhir . '.xlsx"');
		header('Cache-Control: max-age=0');

		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
		$objWriter->save('php://output');

		Yii::app()->end();
		spl_autoload_register(array('YiiBase', 'autoload'));
	}

	// Laporan Kunjungan
	public function actionKunjungan()
	{
		$model = new LaporanPeriode;
		$model->awal = date("01-m-Y");
		$model->akhir = date("d-m-Y");

		if (isset($_POST['LaporanPeriode'])) {
			$model->attributes = $_POST['LaporanPeriode'];
			if ($model->validate()) {
				$pdf = new CetakKunjungan('P', 'cm', 'A4', $model->awal, $model->akhir);
				$pdf->SetMargins(0.5, 0.5, 0.5);
				$pdf->AddPage();
				$pdf->Report($model->awal, $model->akhir);
				$pdf->Output();
			}
		}

		$this->render('kunjungan', array('model' => $model));
	}

	public function actionKunjungan1()
	{
		$model = new LaporanPeriode;
		$model->awal = date("01-m-Y");
		$model->akhir = date("d-m-Y");

		if (isset($_POST['LaporanPeriode'])) {
			$model->attributes = $_POST['LaporanPeriode'];
			if ($model->validate()) {
				$pdf = new CetakKunjungan1('P', 'cm', 'A4', $model->awal, $model->akhir);
				$pdf->SetMargins(0.5, 0.5, 0.5);
				$pdf->AddPage();
				$pdf->Report($model->awal, $model->akhir);
				$pdf->Output();
			}
		}

		$this->render('kunjungan', array('model' => $model));
	}

	public function actionKunjungan2()
	{
		$model = new LaporanPeriode;
		$model->awal = date("01-m-Y");
		$model->akhir = date("d-m-Y");

		if (isset($_POST['LaporanPeriode'])) {
			$model->attributes = $_POST['LaporanPeriode'];
			if ($model->validate()) {
				$pdf = new CetakKunjungan2('P', 'cm', 'A4', $model->awal, $model->akhir);
				$pdf->SetMargins(0.5, 0.5, 0.5);
				$pdf->AddPage();
				$pdf->Report($model->awal, $model->akhir);
				$pdf->Output();
			}
		}

		$this->render('kunjungan', array('model' => $model));
	}

	public function actionKunjungan3()
	{
		$model = new LaporanPeriode;
		$model->awal = date("01-m-Y");
		$model->akhir = date("d-m-Y");

		if (isset($_POST['LaporanPeriode'])) {
			$model->attributes = $_POST['LaporanPeriode'];
			if ($model->validate()) {
				$pdf = new CetakKunjungan3('P', 'cm', 'A4', $model->awal, $model->akhir);
				$pdf->SetMargins(0.5, 0.5, 0.5);
				$pdf->AddPage();
				$pdf->Report($model->awal, $model->akhir);
				$pdf->Output();
			}
		}

		$this->render('kunjungan', array('model' => $model));
	}
	// Laporan Kunjungan

	// Laporan Pemeriksaan
	public function actionPemeriksaan()
    {
        $model = new LaporanPeriode;
        $model->awal = date("01-m-Y");
        $model->akhir = date("t-m-Y");

        if (isset($_POST['LaporanPeriode'])) {
            $model->attributes = $_POST['LaporanPeriode'];
            if ($model->validate()) {
                $pdf = new CetakPemeriksaan('L', 'mm', 'Legal', $model->awal, $model->akhir);
                $pdf->SetMargins(5, 5, 5);
                $pdf->AliasNbPages();
                $pdf->AddPage();
                $pdf->Report($model->awal, $model->akhir);
                $pdf->Output();
            }
        }

        $this->render('pemeriksaan', array('model' => $model));
    }

	public function actionPemeriksaan_()
	{
		$model = new LaporanPeriode;
		$model->awal = date("01-m-Y");
		$model->akhir = date("d-m-Y");

		if (isset($_POST['LaporanPeriode'])) {
			$model->attributes = $_POST['LaporanPeriode'];
			if ($model->validate()) {
				$pdf = new CetakPemeriksaan('P', 'cm', 'A4', $model->awal, $model->akhir);
				$pdf->SetMargins(0.5, 0.5, 0.5);
				$pdf->AddPage();
				$pdf->Report($model->awal, $model->akhir);
				$pdf->Output();
			}
		}

		$this->render('pemeriksaan', array('model' => $model));
	}
	// Laporan Pemeriksaan

	// Laporan Respon Time
	public function actionRespon()
	{
		$model = new LaporanPeriode;
		$model->awal = date("01-m-Y");
		$model->akhir = date("d-m-Y");

		if (isset($_POST['LaporanPeriode'])) {
			$model->attributes = $_POST['LaporanPeriode'];
			if ($model->validate()) {
				$pdf = new CetakRespon('L', 'mm', array(216, 356), $model->awal, $model->akhir);
				$pdf->SetMargins(5, 5, 5);
				$pdf->AliasNbPages();
				$pdf->AddPage();
				$pdf->Report($model->awal, $model->akhir);
				$pdf->Output();
			}
		}

		$this->render('respon', array('model' => $model));
		// Laporan Respon Time
	}
}
