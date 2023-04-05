<?php
class CetakSuratPcr extends fpdf
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

		$this->setFont('Arial', 'B', 10);
		$this->Ln(0.5);
		$this->Cell(0, 0.5, Pengaturan::item('kota'), 0, 0, 'C');

		$y = $this->GetY() + 0.6;

		$this->Line(0.5, $y, 20.5, $y);

		$this->setFont('Arial', 'B', 12);

		$this->Ln(1);
		$this->Cell(0, 0.5, 'LETTER OF STATEMENT', 0, 0, 'C');

		$this->setFont('Arial', '', 10);

		$this->Ln(1);
		$this->SetX(2);
		$this->Cell(3, 0.5, 'The undersigned, the Doctor in Charge of the PCR examiner at the General Hospital Dr. Soemarno Sostroatmodjo');

		$this->Ln(0.7);
		$this->SetX(2);
		$this->Cell(3, 0.5, 'Kapuas, explained that, on behalf of:');

		$this->Ln(1.5);
		$this->SetX(2);
		$this->Cell(3, 0.5, 'Name', 0, 0, 'L');
		$this->Cell(6.7, 0.5, ': ' . $model->idPasien->nama, 0, 0, 'L');

		$this->Ln(0.7);
		$this->SetX(2);
		$this->Cell(3, 0.5, 'Date of Birth', 0, 0, 'L');
		$this->Cell(6.7, 0.5, ': ' . $model->idPasien->tgl_lahir, 0, 0, 'L');

		$this->Ln(0.7);
		$this->SetX(2);
		$this->Cell(3, 0.5, 'Citizenship', 0, 0, 'L');
		$this->Cell(7, 0.5, ': Indonesia', 0, 0, 'L');

		$this->Ln(0.7);
		$this->SetX(2);
		$this->Cell(3, 0.5, 'Passport Number', 0, 0, 'L');
		$this->Cell(6.7, 0.5, ': ' , 0, 0, 'L');

		$this->Ln(0.7);
		$this->SetX(2);
		$this->Cell(3, 0.5, 'Date of Test', 0, 0, 'L');
		$this->Cell(7, 0.5, ': ' . date("d-m-Y", strtotime($model->tanggal)), 0, 0, 'L');

		$this->Ln(0.7);
		$this->SetX(2);
		$this->Cell(3, 0.5, 'Time', 0, 0, 'L');
		$this->Cell(7, 0.5, ': Western Indonesia Time', 0, 0, 'L');

		$this->Ln(1);
		$this->SetX(2);
		$this->Cell(3, 0.5, 'A PCR examination was carried out with nasopharyngeal swabs, as stated :');
	}

	function Report($id)
	{
		$model = Periksa::model()->findByPk($id);

		$sql1 = "SELECT b.id AS parent_id, b.nama, a.Nilai, a.keterangan, b.satuan, b.metoda, a.KodeParamater, a.acc, a.id, b.parameter, b.pembulatan, b.lis
		FROM result a LEFT JOIN kode b ON a.KodeParamater=b.lis WHERE a.KodePatient LIKE '%$model->nomor%' AND a.acc='1' AND b.lis='PCR'";
		$data1 = Yii::app()->db->createCommand($sql1)->queryRow();

		$this->Ln(1);
		$this->setFont('Arial', 'B', 12);
		$this->Cell(0, 0.5, strtoupper($data1['Nilai']) . ' SARS COV-2', 0, 0, 'C');

		$this->setFont('Arial', '', 10);
		$this->Ln(1);
		$this->SetX(2);
		$this->Cell(3, 0.5, 'This Statement is made truthfully and to be used accordingly.');

		$this->Ln(2);
		$this->SetX(13);
		$this->Cell(3.5, 0.5, 'Kapuas, ' . Parameter::tanggalLengkap($model->tanggal), 0, 0, 'C');

		$this->Ln(0.5);
		$this->SetX(13);
		$this->Cell(3.5, 0.5, 'Doctor In Charge Microbiology Laboratory', 0, 0, 'C');

		$this->Ln(0.5);
		$this->SetX(13);
		$this->Cell(3.5, 0.5, 'General Hospital Dr. H. Soemarno Sostroadmodjo Kapuas', 0, 0, 'C');

		$y = $this->GetY() + 0.5;
		if (file_exists('images/' . Dokter::getTtd($model->id_dokter2) . '.png')) {
			$this->Image('images/' . Dokter::getTtd($model->id_dokter2), 13.8, $y, 2);
		}

		$this->setFont('Arial', 'BU', 10);

		$this->Ln(2.5);
		$this->SetX(13);
		$this->Cell(3.5, 0.5, Dokter::item($model->id_dokter2), 0, 0, 'C');

		$this->setFont('Arial', '', 8);
		$this->Ln(0.4);
		$this->SetX(13);
		$this->Cell(3.5, 0.5, 'NIP. ' . Dokter::getField($model->id_dokter2, 'nip'), 0, 0, 'C');
	}
}
