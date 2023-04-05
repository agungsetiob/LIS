<?php
class CetakPeriksaPending extends code128
{
	function Header()
	{
		$this->SetTextColor(0, 0, 0);
		$this->SetAutoPageBreak(true, 1.5);

		// if ($this->PageNo() != 1) {
		// 	$this->Ln(0.5);
		// }

		$this->Ln(0.7);
		$this->setFont('Arial', '', 16);
		$this->Cell(0, 0.5, Pengaturan::item('nama_rs'), 0, 0, 'C');

		$this->setFont('Arial', '', 10);
		$this->Ln(0.6);
		$this->Cell(0, 0.5, Pengaturan::item('alamat_rs'), 0, 0, 'C');

		$y = $this->GetY() + 0.6;

		$this->Line(0.5, $y, 20.5, $y);

		$this->Ln(1);
		$this->setFont('Arial', '', 14);
		$this->Cell(0, 0.5, 'PEMERIKSAAN PENDING', 0, 0, 'C');

		$this->Ln(1);
		$this->setFont('Arial', '', 10);
		$this->Cell(1, 1, 'No', 1, 0, 'C');
		$this->Cell(10, 1, 'Nama', 1, 0, 'C');
		$this->Cell(6.5, 1, 'Barcode', 1, 0, 'C');
		$this->Cell(2.5, 1, 'No LIS', 1, 0, 'C');
	}

	function Report()
	{
		$model = Periksa::model()->findAll('state = 0');

		$no = 1;
		foreach ($model as $data) {
			if ($no == 1 or $no == 11) {
				$y = $this->GetY() - 0.8;
				$this->Ln(1);
			} else {
				$y = $this->GetY();
				$this->Ln(2);
			}
			$this->Cell(1, 2, $no, 'LR', 0, 'C');
			$this->Cell(10, 2, $data->idPasien->nama, 'LR', 0, 'L');
			$this->Cell(6.5, 2, '', 'LR', 0, 'C');
			$this->Cell(2.5, 2, $data->nomor, 'LR', 0, 'C');
			$this->Code128(11.9, $y + 2, $data->nomor, 5.8, 1.5);

			if ($no == 10 or $no == 20 or $no == 30 or $no == 40 or $no == 50 or $no == 60 or $no == 70 or $no == 80) {
				$this->Line(0.5, 34.8, 20.5, 34.8);
				$this->AddPage();
			}

			$no++;
		}
	}
}
