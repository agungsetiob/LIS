<?php
class CetakPemeriksaan extends pdf
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

		$this->Line(5, $y, 350, $y);

		$this->setFont('Arial', 'U', 16);
		$this->Ln(10);
		$this->Cell(0, 5, 'LAPORAN PEMERIKSAAN', 0, 0, 'C');

		$this->setFont('Arial', '', 10);

		$this->Ln(5);
		$this->Cell(8, 5, 'Periode : ' . $this->tawal . ' s/d ' . $this->takhir, 0, 0, 'L');

		$this->SetX(-20);
		$this->Cell(10, 5, 'Hal : ', 0, 0, 'L');
		$this->SetX(-12);
		$this->Cell(1, 5, $this->PageNo() . '/{nb}', 0, 0, 'L');

		$tgl1 = (int) date("d", strtotime($this->tawal));
		$tgl2 = (int) date("d", strtotime($this->takhir));

		$this->Ln(5);
		$this->Cell(10, 5, 'NO', 1, 0, 'C');
		$this->Cell(70, 5, 'PEMERIKSAAN', 1, 0, 'C');
		for ($i = $tgl1; $i <= $tgl2; $i++) {
			$this->Cell(8, 5, $i, 1, 0, 'C');
		}
		$this->Cell(17, 5, 'TOTAL', 1, 0, 'C');

		$this->SetAutoPageBreak(true, 5);

		if ($this->PageNo() != 1) {
			$this->Ln(5);
		}
	}

	function Report($awal, $akhir)
	{
		$tgl1 = (int) date("d", strtotime($awal));
		$tgl2 = (int) date("d", strtotime($akhir));
		$bulan = date("Y-m-", strtotime($akhir));

		$awal = Parameter::tglMySQL($awal);
		$akhir = Parameter::tglMySQL($akhir);

		$sql = "SELECT b.nama, a.KodeParamater FROM result a LEFT JOIN kode b ON a.KodeParamater = b.lis WHERE DATE(a.tanggal) BETWEEN '$awal' AND '$akhir' AND acc = '1' GROUP BY KodeParamater ORDER BY b.`order`";

		$no = 1;
		$model = Yii::app()->db->createCommand($sql)->queryAll();
		foreach ($model as $data) {
			$this->Ln(5);
			$this->Cell(10, 5, $no, 1, 0, 'C');
			$this->Cell(70, 5, $data['nama'], 1, 0, 'L');

			$totalP = 0;
			for ($i = $tgl1; $i <= $tgl2; $i++) {
				$tanggal = $bulan . '' . $i;
				$jumlah = Laporan::getPemeriksaan($tanggal, $data['KodeParamater']);

				$this->Cell(8, 5, $jumlah, 1, 0, 'C');

				$totalP += $jumlah;
			}
			$this->Cell(17, 5, $totalP, 1, 0, 'C');

			$no++;
		}
	}
}
