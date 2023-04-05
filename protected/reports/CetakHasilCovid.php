<?php
class CetakHasilCovid extends fpdf
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
		$this->Cell(13.5, 0.6, 'Pemeriksaan', 1, 0, 'L');
		$this->Cell(3, 0.6, 'Hasil', 1, 0, 'C');
		$this->Cell(3.5, 0.6, 'Nilai Normal', 1, 0, 'C');
	}

	function Report($id)
	{
		$model = Periksa::model()->findByPk($id);

		$this->setFont('Arial', 'B', 10);
		$this->SetTextColor(102, 0, 0);
		$this->Ln(0.6);
		$this->Cell(7, 0.6, 'IMUNOLOGI/SEROLOGI', 0, 0, 'L');
		$this->Cell(3, 0.6, '', 0, 0, 'C');
		$this->Cell(3.5, 0.6, '', 0, 0, 'C');
		$this->Cell(2, 0.6, '', 0, 0, 'C');
		$this->Cell(4.5, 0.6, '', 0, 0, 'C');

		$this->setFont('Arial', '', 10);
		$this->SetTextColor(0, 0, 0);
		$this->Ln(0.6);
		$this->Cell(0.8, 0.6, '', 0, 0, 'L');
		$this->Cell(12.7, 0.6, 'Antigen SARS-CoV-2', 0, 0, 'L');

		$nilai = Result::getNilai($model->nomor, 'Swab Antigen Covid 19');
		
		$this->Cell(3, 0.6, $nilai, 0, 0, 'C');
		$this->Cell(3.5, 0.6, 'Negative', 0, 0, 'C');

		$y = $this->GetY() + 0.6;

		$this->Line(0.5, $y, 20.5, $y);

		$this->Ln(0.8);
		$this->Cell(2, 0.5, 'Catatan : ' . $model->note, 0, 0, 'L');

		$this->Ln(0.5);
		if($nilai == 'POSITIF') {
			$this->Cell(0.3, 0.5, '-  ', 0, 0, 'L');
			$this->MultiCell(19.7, 0.5, 'Pemeriksaan konfirmasi dengan pemeriksaan RT-PCR', 0);

			$this->Cell(0.3, 0.5, '-  ', 0, 0, 'L');
			$this->MultiCell(19.7, 0.5, 'Lakukan karantina atau isolasi sesuai dengan kriteria', 0);

			$this->Cell(0.3, 0.5, '-  ', 0, 0, 'L');
			$this->MultiCell(19.7, 0.5, 'Menerapkan PHBS 9 perilaku hidup bersih dan sehat: mencuci tangan, menerapkan etika batuk, menggunakan masker saat sakit, menjaga stamina dan physical distancing', 0);
		} else {
			$this->Cell(0.3, 0.5, '-  ', 0, 0, 'L');
			$this->MultiCell(19.7, 0.5, 'Hasil negatif tidak menyingkirkan kemungkinan terinfeksi SARS-co-V-2 sehingga masih berisiko menularkan ke orang lain, disarankan tes ulang atau tes konfirmasi dengan NAAT, bila probabilitas pretes relatif tinggi, terutama bila pasien bergejala atau diketahui memiliki kontak dengan orang yang terkonfirmasi COVID-19', 0);

			$this->Cell(0.3, 0.5, '-  ', 0, 0, 'L');
			$this->MultiCell(19.7, 0.5, 'Hasil Negatif dapat terjadi pada kondisi kuantitas antigen pada spesimen dibawah level deteksi alat', 0);
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
		$this->SetX(7);
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

	// function Footer()
	// {
	// 	$this->setFont('Arial', '', 10);

	// 	$this->SetY(-5.25);

	// 	$y = $this->GetY() + 0.5;
	// 	$this->Line(0.5, $y, 20.5, $y);

	// 	$this->SetY(-4.6);
	// 	$this->Cell(2, 0.5, 'Halaman ' . $this->PageNo() . ' dari {nb}', 0, 0, 'L');

	// 	$this->SetX(-2.5);
	// 	$this->Cell(1, 0.5, 'Tanggal Cetak : ' . date("d-m-Y H:i:s"), 0, 0, 'R');
	// }
}
