<?php
class CetakHasil extends fpdf
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
		$this->Cell(7, 0.6, 'Pemeriksaan', 1, 0, 'L');
		$this->Cell(3, 0.6, 'Hasil', 1, 0, 'C');
		$this->Cell(3.5, 0.6, 'Nilai Rujukan', 1, 0, 'C');
		$this->Cell(2, 0.6, 'Satuan', 1, 0, 'C');
		$this->Cell(4.5, 0.6, 'Metode', 1, 0, 'C');
	}

	function Report($id)
	{
		$model = Periksa::model()->findByPk($id);
		$waktu = VPasien::getField($model->id_pasien, 'umur_hari');

		//	GRUP 1
		$sql = "SELECT b.grup1 FROM result a LEFT JOIN kode b ON a.KodeParamater=b.lis LEFT JOIN v_grup c ON b.grup1=c.nama WHERE a.KodePatient LIKE '%$model->nomor%' AND a.acc='1' AND a.KodeParamater NOT LIKE '%-MDT%' GROUP BY b.grup1 ORDER BY c.order";
		$detail = Yii::app()->db->createCommand($sql)->queryAll();

		$no = 1;
		foreach ($detail as $data) {
			$this->setFont('Arial', 'B', 10);
			$this->SetTextColor(102, 0, 0);
			$this->Ln(0.6);
			$this->Cell(1, 0.6, '', 0, 0, 'L');
			$this->Cell(6, 0.6, $data['grup1'], 0, 0, 'L');
			$this->Cell(3, 0.6, '', 0, 0, 'C');
			$this->Cell(3.5, 0.6, '', 0, 0, 'C');
			$this->Cell(2, 0.6, '', 0, 0, 'C');
			$this->Cell(4.5, 0.6, '', 0, 0, 'C');
			$no++;

			//	GRUP 2
			$sql22 = "SELECT b.grup2 FROM result a LEFT JOIN kode b ON a.KodeParamater=b.lis LEFT JOIN v_grup2 c ON b.grup2=c.nama
			WHERE a.KodePatient LIKE '%$model->nomor%' AND b.grup1='$data[grup1]' AND a.acc='1' GROUP BY b.grup2 ORDER BY c.order";
			$detail22 = Yii::app()->db->createCommand($sql22)->queryAll();

			foreach ($detail22 as $data22) {
				if ($data['grup1'] != $data22['grup2']) {
					$this->setFont('Arial', 'B', 10);
					$this->SetTextColor(102, 0, 0);
					$this->Ln(0.6);
					$this->Cell(1.3, 0.6, '', 0, 0, 'L');
					$this->Cell(5.7, 0.6, $data22['grup2'], 0, 0, 'L');
					$this->Cell(3, 0.6, '', 0, 0, 'C');
					$this->Cell(3.5, 0.6, '', 0, 0, 'C');
					$this->Cell(2, 0.6, '', 0, 0, 'C');
					$this->Cell(4.5, 0.6, '', 0, 0, 'C');
				}

				if ($this->GetY() >= '26') {
					$this->SetTextColor(0, 0, 0);
					$this->AddPage();
				}

				//	GRUP 3
				$sql222 = "SELECT b.grup3 FROM result a LEFT JOIN kode b ON a.KodeParamater=b.lis LEFT JOIN v_grup3 c ON b.grup3=c.nama
				WHERE a.KodePatient LIKE '%$model->nomor%' AND b.grup2='$data22[grup2]' AND a.acc='1' GROUP BY b.grup3 ORDER BY c.order";
				$detail222 = Yii::app()->db->createCommand($sql222)->queryAll();

				foreach ($detail222 as $data222) {
					if ($data22['grup2'] != $data222['grup3']) {
						$this->setFont('Arial', 'B', 10);
						$this->SetTextColor(102, 0, 0);
						$this->Ln(0.6);
						$this->Cell(1.6, 0.6, '', 0, 0, 'L');
						$this->Cell(5.4, 0.6, $data222['grup3'], 0, 0, 'L');
						$this->Cell(3, 0.6, '', 0, 0, 'C');
						$this->Cell(3.5, 0.6, '', 0, 0, 'C');
						$this->Cell(2, 0.6, '', 0, 0, 'C');
						$this->Cell(4.5, 0.6, '', 0, 0, 'C');
					}

					if ($this->GetY() >= '26') {
						$this->SetTextColor(0, 0, 0);
						$this->AddPage();
					}

					$sql2 = "SELECT b.id, b.nama, a.Nilai, a.keterangan, b.satuan, b.metoda, a.KodeParamater, a.acc, a.id, b.parameter, b.pembulatan
					FROM result a LEFT JOIN kode b ON a.KodeParamater=b.lis WHERE a.KodePatient LIKE '%$model->nomor%' AND a.acc='1' AND b.grup3='$data222[grup3]' GROUP BY b.nama ORDER BY b.order";
					$detail2 = Yii::app()->db->createCommand($sql2)->queryAll();

					foreach ($detail2 as $data2) {
						if ($this->GetY() >= '26') {
							$this->SetTextColor(0, 0, 0);
							$this->AddPage();
						}
						if ($data2['pembulatan'] == 0) {
							$nilai = round($data2['Nilai']);
						} else if ($data2['pembulatan'] == 99) {
							$nilai = $data2['Nilai'];
						} else {
							$nilai = round($data2['Nilai'], $data2['pembulatan']);
						}

						$nilaiFormula = Formula::getNilai($data2['KodeParamater'], $model->nomor);
						if ($nilaiFormula != 0) {
							$nilai = $nilaiFormula;
						}

						$flag = VKode::getFlag($data2['KodeParamater'], $data2['parameter'], $waktu, $model->idPasien->gender, $nilai);
						$kritis = VKode::getKritis($data2['KodeParamater'], $data2['parameter'], $waktu, $model->idPasien->gender, $nilai);

						$this->setFont('Arial', '', 10);
						$this->SetTextColor(0, 0, 0);
						$this->Ln(0.6);
						$this->Cell(1.8, 0.6, '', 0, 0, 'L');
						$this->Cell(5.2, 0.6, $data2['nama'], 0, 0, 'L');
						if ($flag != '') {
							$this->setFont('Arial', 'B', 10);
						}

						if ($kritis == '#') {
							$flag = $kritis;
						}

						$this->Cell(3, 0.6, $nilai . ' ' . $flag, 0, 0, 'C');
						$this->setFont('Arial', '', 10);
						$this->Cell(3.5, 0.6, VKode::getField($data2['KodeParamater'], $data2['parameter'], $waktu, $model->idPasien->gender, 'nr'), 0, 0, 'C');
						$this->Cell(2, 0.6, $data2['satuan'], 0, 0, 'C');
						$this->Cell(4.5, 0.6, $data2['metoda'], 0, 0, 'L');
					}
				}
			}
		}

		$this->SetTextColor(0, 0, 0);

		$y = $this->GetY() + 0.6;

		$this->Line(0.5, $y, 20.5, $y);

		$this->Ln(0.8);
		$this->Cell(1, 0.5, '', 0, 0, 'L');
		$this->Cell(2, 0.5, 'L/H = Diluar batas nilai rujukan', 0, 0, 'L');

		$this->Ln(0.5);
		$this->Cell(1, 0.5, '', 0, 0, 'L');
		$this->Cell(2, 0.5, '# = Nilai kritis', 0, 0, 'L');

		if($model->ket_verifikasi != '') {
			$this->Ln(0.5);
			$this->MultiCell(20, 0.5, 'Catatan : ' . $model->ket_verifikasi, 0);
		}

		$this->Ln(1.8);
		if ($this->GetY() >= '26') {
			$this->SetTextColor(0, 0, 0);
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
		$this->Cell(3.5, 0.5, 'Pemeriksa Laboratorium', 0, 0, 'C');

		$this->SetX(15);
		$this->Cell(3.5, 0.5, 'Dokter Penanggung Jawab', 0, 0, 'C');

		$y = $this->GetY() + 0.4;
		if (file_exists('images/dokter.png')) {
			$this->Image('images/dokter.png', 15.5, $y, 2.3);
		}

		$this->setFont('Arial', 'B', 10);

		$this->Ln(2.5);
		$this->SetX(7);
		$this->Cell(3.5, 0.5, Petugas::item($model->id_petugas), 0, 0, 'C');

		$this->SetX(15);
		$this->Cell(3.5, 0.5, Dokter::item($model->id_dokter2), 0, 0, 'C');

		$this->setFont('Arial', '', 8);
		$this->Ln(0.4);
		$this->SetX(15);
	}
}