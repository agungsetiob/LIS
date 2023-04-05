<?php
class CetakKritis extends pdf
{
	function Header()
	{
		$this->Image('images/logo.png', 16, 8, 20);

		$this->Ln(5);
		$this->setFont('Arial', '', 16);
		$this->Cell(0, 5, Pengaturan::item('nama_rs'), 0, 0, 'C');

		$this->setFont('Arial', '', 16);
		$this->Ln(7);
		$this->Cell(0, 5, Pengaturan::item('nama_app'), 0, 0, 'C');

		$this->setFont('Arial', '', 12);
		$this->Ln(6);
		$this->Cell(0, 5, Pengaturan::item('alamat_rs'), 0, 0, 'C');

		$y = $this->GetY() + 7;

		$this->Line(5, $y, 351, $y);

		$this->setFont('Arial', 'U', 16);
		$this->Ln(10);
		$this->Cell(0, 5, 'LAPORAN NILAI KRITIS', 0, 0, 'C');

		$this->setFont('Arial', '', 16);

		$this->Ln(7);
		$this->Cell(0, 5, strtoupper(Kode::item($this->supplier)), 0, 0, 'C');

		$this->setFont('Arial', '', 10);

		$this->Ln(5);
		$this->Cell(8, 5, 'Periode : ' . $this->tawal . ' s/d ' . $this->takhir, 0, 0, 'L');

		$this->SetX(-20);
		$this->Cell(1, 5, 'Hal : ', 0, 0, 'L');
		$this->SetX(-12);
		$this->Cell(1, 5, $this->PageNo() . '/{nb}', 0, 0, 'L');

		$this->Ln(5);
		$this->Cell(8, 5, 'No', 1, 0, 'C');
		$this->Cell(28, 5, 'No. Lab', 1, 0, 'C');
		$this->Cell(28, 5, 'No. RM', 1, 0, 'C');
		$this->Cell(71, 5, 'Nama Pasien', 1, 0, 'L');
		$this->Cell(10, 5, 'JK', 1, 0, 'C');
		$this->Cell(20, 5, 'Umur Thn', 1, 0, 'C');
		$this->Cell(31, 5, 'Status', 1, 0, 'L');
		$this->Cell(100, 5, 'Rujukan Dokter', 1, 0, 'L');
		$this->Cell(50, 5, 'Petugas Lab', 1, 0, 'L');

		$this->SetAutoPageBreak(true, 5);

		if ($this->PageNo() != 1) {
			$this->Ln(5);
		}
	}

	function Report($awal, $akhir, $item)
	{
		$this->Ln(5);
		$this->setwidths(array(8, 28, 28, 71, 10, 20, 31, 100, 50));
		$this->iscustomborder = True;
		$this->coldetailalign = array('C', 'C', 'C', 'L', 'C', 'C', 'L', 'L', 'L', 'C');
		$this->setbordercell(array('LR', 'LR', 'LR', 'LR', 'LR', 'LR', 'LR', 'LR', 'LR', 'LR'));

		$awal = Parameter::tglMySQL($awal);
		$akhir = Parameter::tglMySQL($akhir);
		$kode = Kode::model()->findByPk($item);

		$sql = "SELECT a.nomor, c.nama, c.no_rm, c.gender, c.tgl_lahir, c.state, a.id_dokter, a.id_petugas, b.Nilai, d.pembulatan FROM periksa a LEFT JOIN result b ON a.nomor=b.KodePatient LEFT JOIN pasien c ON a.id_pasien=c.id LEFT JOIN kode d ON b.KodeParamater=d.lis WHERE DATE(a.tanggal) BETWEEN '$awal' AND '$akhir' AND a.state='1' AND b.acc='1' AND b.KodeParamater='$kode->lis' ORDER BY a.nomor";
		$no = 1;
		$model = Yii::app()->db->createCommand($sql)->queryAll();
		foreach ($model as $data) {
			$y = $this->GetY();

			$umur = Pasien::umur($data['tgl_lahir']);
			$aumur = explode(",", $umur);
			$waktu =  count($aumur);

			if ($data['pembulatan'] == 0) {
				$nilai = round($data['Nilai']);
			} else if ($data['pembulatan'] == 99) {
				$nilai = $data['Nilai'];
			} else {
				$nilai = round($data['Nilai'], $data['pembulatan']);
			}

			$flag = VKode::getFlag($kode->lis, $data['parameter'], $waktu, $data['gender'], $nilai);
			$kritis = VKode::getKritis($kode->lis, $data['parameter'], $waktu, $data['gender'], $nilai);

			if ($kritis == '#') {
				$flag = $kritis;

				$this->row(array(
					$no,
					$data['nomor'],
					$data['no_rm'],
					$data['nama'],
					Parameter::getGender($data['gender']),
					Pasien::umur2($data['tgl_lahir']),
					Parameter::item("cStatePasien", $data['state']),
					Dokter::item($data['id_dokter']),
					Petugas::item($data['id_petugas']),
				));

				$no++;
			}

			if ($y == 195) {
				$this->Line(5, 205, 351, 205);
			}
		}

		$y = $this->GetY();

		$this->Line(5, $y, 351, $y);
	}
}
