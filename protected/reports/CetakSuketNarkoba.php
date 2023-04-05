<?php
class CetakSuketNarkoba extends fpdf
{
	function Header()
	{
		$this->SetAutoPageBreak(true, 1.5);

		if ($this->PageNo() != 1) {
			$this->Ln(0.5);
		}

		$model = Periksa::model()->findByPk($this->tawal);

		$this->Image('images/kapuas.png', 0.5, 0.8, 2);
		$this->Image('images/logo.png', 18.5, 0.8, 2);

		$this->Ln(0);
		$this->setFont('Arial', '', 16);
		$this->Cell(0, 0.5, Pengaturan::item('pemda'), 0, 0, 'C');

		$this->Ln(0.6);
		$this->Cell(0, 0.5, Pengaturan::item('nama_rs'), 0, 0, 'C');

		$this->setFont('Arial', '', 10);
		$this->Ln(0.5);
		$this->Cell(0, 0.5, Pengaturan::item('alamat_rs'), 0, 0, 'C');

		$this->Ln(0.4);
		$this->Cell(0, 0.5, Pengaturan::item('email'), 0, 0, 'C');

		$this->setFont('Arial', '', 16);
		$this->Ln(0.6);
		$this->Cell(0, 0.5, Pengaturan::item('kota'), 0, 0, 'C');

		$y = $this->GetY() + 0.6;

		$this->Line(0.5, $y, 20.5, $y);

		$this->setFont('Arial', 'B', 12);
		$this->Ln(1);
		$this->Cell(0, 0.5, 'SURAT KETERANGAN BEBAS NARKOBA', 0, 0, 'C');
	}

	function Report($id)
	{
		$model = Periksa::model()->findByPk($id);

		$this->setFont('Arial', '', 10);
		$this->Ln(1);
		$this->Cell(0, 0.8, 'Yang bertanda tangan di bawah ini Dokter ' . Pengaturan::item('nama_rs') . ' dengan ini menerangkan bahwa :', 0, 0, 'L');

		$this->Ln(0.8);
		$this->Cell(4.5, 0.8, 'Nama', 0, 0, 'L');
		$this->Cell(4.5, 0.8, ': ' . $model->idPasien->nama, 0, 0, 'L');

		$this->Ln(0.8);
		$this->Cell(4.5, 0.8, 'Tempat / Tanggal Lahir', 0, 0, 'L');
		$this->Cell(4.5, 0.8, ': ' . $model->idPasien->tempat_lahir . ', ' . $model->idPasien->tgl_lahir, 0, 0, 'L');

		$this->Ln(0.8);
		$this->Cell(4.5, 0.8, 'Jenis Kelamin', 0, 0, 'L');
		$this->Cell(4.5, 0.8, ': ' . Parameter::item("cSex", $model->idPasien->gender), 0, 0, 'L');

		$this->Ln(0.8);
		$this->Cell(4.5, 0.8, 'Pekerjaan', 0, 0, 'L');
		$this->Cell(4.5, 0.8, ': -', 0, 0, 'L');

		$this->Ln(0.8);
		$this->Cell(4.5, 0.8, 'Alamat', 0, 0, 'L');
		$this->Cell(4.5, 0.8, ': ' . $model->idPasien->alamat, 0, 0, 'L');

		$this->Ln(0.8);
		$this->Cell(0, 0.8, 'Telah dilakukan pemeriksaan beberapa zat adiktif / narkoba pada urine yang bersangkutan dengan hasil sebagai berikut:', 0, 0, 'L');

		$sql = "SELECT b.nama, a.Nilai, a.keterangan, b.satuan, b.metoda, a.KodeParamater, a.acc, a.id, b.parameter, b.pembulatan
		FROM result a LEFT JOIN kode b ON a.KodeParamater=b.lis WHERE a.KodePatient LIKE '%$model->nomor%' AND a.acc='1' AND b.grup1='NARKOBA' ORDER BY b.order";
		$detail = Yii::app()->db->createCommand($sql)->queryAll();

		$no = 65;
		foreach ($detail as $data) {
			$alphabet = chr($no);

			$this->Ln(0.8);
			$this->Cell(7, 0.8, $alphabet . '. ' . $data['nama'], 0, 0, 'L');
			$this->Cell(5, 0.8, ': ' . $data['Nilai'], 0, 0, 'L');

			$no++;
		}

		$this->Ln(0.8);
		$this->Cell(0, 0.8, 'Kesumpulan : yang bersangkutan bebas dari zat adiktif / narkoba tersebut.', 0, 0, 'L');

		$this->Ln(0.8);
		$this->Cell(0, 0.8, 'Dengan surat keterangan ini dibuat dengan sebenarnya, untuk dapat dipergunakan sebagaimana mestinya.', 0, 0, 'L');

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
		if (file_exists('images/qrcode/' . $model->nomor . '.png')) {
			$this->Image('images/qrcode/' . $model->nomor . '.png', 0.8, $y, 3.5);
		}
		//QRCode

		$this->setFont('Arial', '', 10);
		$this->SetX(15);
		$this->Cell(3.5, 0.5, 'Dokter Penanggung Jawab', 0, 0, 'C');

		$y = $this->GetY() + 0.5;
		if (file_exists('images/' . Dokter::getTtd($model->id_dokter) . '.png')) {
			$this->Image('images/' . Dokter::getTtd($model->id_dokter), 13.8, $y, 2);
		}

		$this->setFont('Arial', 'BU', 10);

		$this->Ln(2.5);
		$this->SetX(15);
		$this->Cell(3.5, 0.5, Dokter::item($model->id_dokter2), 0, 0, 'C');

		$this->setFont('Arial', '', 8);
		$this->Ln(0.4);
		$this->SetX(15);
		$this->Cell(3.5, 0.5, 'NIP. ' . Dokter::getField($model->id_dokter2, 'nip'), 0, 0, 'C');
	}
}
