<?php
class CetakHasilGdt extends fpdf
{
	function Header()
	{
		$this->SetAutoPageBreak(true, 1.5);

		if ($this->PageNo() != 1) {
			$this->Ln(0.5);
		}

		$model = Periksa::model()->findByPk($this->tawal);

		$this->Image('images/tb.png', 0.5, 0.8, 1.5);
		$this->Image('images/logo.png', 18.5, 0.8, 1.9);

		$this->Ln(0);
		$this->setFont('Arial', '', 16);
		$this->Cell(0, 0.5, Pengaturan::item('nama_rs'), 0, 0, 'C');

		$this->setFont('Arial', '', 16);
		$this->Ln(0.7);
		$this->Cell(0, 0.5, Pengaturan::item('nama_app'), 0, 0, 'C');

		$this->setFont('Arial', '', 10);
		$this->Ln(0.6);
		$this->Cell(0, 0.5, Pengaturan::item('alamat_rs'), 0, 0, 'C');

		$y = $this->GetY() + 0.6;

		$this->Line(0.5, $y, 20.5, $y);

		$this->setFont('Arial', '', 10);
		$this->Ln(0.7);
		$this->SetX(0.5);
		$this->Cell(2.7, 0.5, 'No. RM', 0, 0, 'L');
		$this->Cell(6.7, 0.5, ': ' . $model->idPasien->no_rm, 0, 0, 'L');

		$this->Cell(4.5, 0.5, 'No. Lab', 0, 0, 'L');
		$this->Cell(7, 0.5, ': ' . $model->nomor, 0, 0, 'L');

		$this->Ln(0.5);
		$this->SetX(0.5);
		$this->Cell(2.7, 0.5, 'Nama Pasien', 0, 0, 'L');
		$this->Cell(6.7, 0.5, ': ' . $model->idPasien->nama, 0, 0, 'L');

		$this->Cell(4.5, 0.5, 'Tanggal & Jam Permintaan', 0, 0, 'L');
		$this->Cell(7, 0.5, ': ' . date("d-m-Y", strtotime($model->tanggal)) . ' (' . date("H:i:s", strtotime($model->tanggal)) . ')', 0, 0, 'L');

		$this->Ln(0.5);
		$this->SetX(0.5);
		$this->Cell(2.7, 0.5, 'Jenis Kelamin', 0, 0, 'L');
		$this->Cell(6.7, 0.5, ': ' . Parameter::item("cSex", $model->idPasien->gender), 0, 0, 'L');

		$this->Cell(4.5, 0.5, 'Tanggal & Jam Validasi', 0, 0, 'L');
		$this->Cell(7, 0.5, ': ' . date("d-m-Y", strtotime($model->tgl_validasi)) . ' (' . date("H:i:s", strtotime($model->tgl_validasi)) . ')', 0, 0, 'L');

		$this->Ln(0.5);
		$this->SetX(0.5);
		$this->Cell(2.7, 0.5, 'Tanggal Lahir', 0, 0, 'L');
		$this->Cell(6.7, 0.5, ': ' . $model->idPasien->tgl_lahir . ' (' . Pasien::umur($model->idPasien->tgl_lahir) . ')', 0, 0, 'L');

		$this->Cell(4.5, 0.5, 'Response Time', 0, 0, 'L');
		$this->Cell(7, 0.5, ': ' . Periksa::getResponTime($model->id), 0, 0, 'L');

		$this->Ln(0.5);
		$this->SetX(0.5);
		$this->Cell(2.7, 0.5, 'Alamat Pasien', 0, 0, 'L');
		$this->Cell(6.7, 0.5, ': ' . substr($model->idPasien->alamat, 0, 30), 0, 0, 'L');

		$this->Cell(4.5, 0.5, 'Asal Ruangan', 0, 0, 'L');
		$this->Cell(7, 0.5, ': ' .Ruang::item($model->id_ruang, 0, 30), 0, 0, 'L');

		$this->Ln(0.5);
		$this->SetX(0.5);
		$this->Cell(2.7, 0.5, 'Diagnosa', 0, 0, 'L');
		$this->Cell(6.7, 0.5, ': ' . $model->ket_klinik, 0, 0, 'L');

		$this->Cell(4.5, 0.5, 'Dokter Pengirim', 0, 0, 'L');
		$this->Cell(7, 0.5, ': ' . substr(Dokter::item($model->id_dokter), 0, 30), 0, 0, 'L');

		$this->setFont('Arial', '', 10);
		$this->Ln(0.7);
		$this->SetX(0.5);
		$this->Cell(20, 0.6, 'MORFOLOGI DARAH TEPI', 1, 0, 'C');
	}

	function Report($id)
	{
		$model = Periksa::model()->findByPk($id);


		$sql = "SELECT b.nama, a.Nilai FROM result a LEFT JOIN kode b ON a.KodeParamater = b.lis WHERE a.KodePatient = '$model->nomor' ORDER BY b.order";
		$detail = Yii::app()->db->createCommand($sql)->queryAll();

		$this->Ln(1);
		foreach ($detail as $data) {
			$this->setFont('Arial', 'B', 10);

			$this->Cell(3.7, 1, $data['nama'], 0, 0, 'L');
			$this->Cell(0.3, 1, ': ', 0, 0, 'L');

			$this->setFont('Arial', '', 10);
			$this->MultiCell(16, 1, $data['Nilai'], 0);
		}

		$this->Ln(1.8);
		if ($this->GetY() >= '30') {
			$this->AddPage();
			$this->Ln(2);
		}

		$this->setFont('Arial', '', 8);
		$this->Cell(2, 0.5, 'Scan untuk memeriksa keaslian hasil test', 0, 0, 'L');
		$this->Ln(0.4);

		//QRCode
		$y = $this->GetY();
		if (file_exists('qrcode/' . $model->nomor . '.png')) {
			$this->Image('qrcode/' . $model->nomor . '.png', 0.8, $y, 3.5);
		}
		//QRCode

		$this->setFont('Arial', '', 10);
		$this->SetX(15);
		$this->Cell(3.5, 0.5, 'Dokter Penanggung Jawab', 0, 0, 'C');

		$y = $this->GetY() + 0.5;
		if (file_exists('images/' . Dokter::getTtd($model->id_dokter2) . '.png')) {
			$this->Image('images/' . Dokter::getTtd($model->id_dokter2), 13.8, $y, 2);
		}

		$this->setFont('Arial', 'BU', 10);

		$this->Ln(2.5);
		$this->SetX(15);
		$this->Cell(3.5, 0.5, Dokter::item($model->id_dokter2), 0, 0, 'C');

		$this->setFont('Arial', '', 8);
		$this->Ln(0.4);
		$this->SetX(15);
		// $this->Cell(3.5, 0.5, 'NIP. ' . Dokter::getField($model->id_dokter2, 'nip'), 0, 0, 'C');
	}

	function Footer()
	{
		// $this->setFont('Arial', '', 10);

		// $this->SetY(-5.25);

		// $y = $this->GetY() + 0.5;
		// $this->Line(0.5, $y, 20.5, $y);

		// $this->SetY(-4.6);
		// $this->Cell(2, 0.5, 'Halaman ' . $this->PageNo() . ' dari {nb}', 0, 0, 'L');

		// $this->SetX(-2.5);
		// $this->Cell(1, 0.5, 'Tanggal Cetak : ' . date("d-m-Y H:i:s"), 0, 0, 'R');
	}
}
