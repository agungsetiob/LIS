<?php
class CetakRespon extends pdf
{
	function Header()
	{
		$this->Image('images/logo.png',16,8,20);

		$this->Ln(5);
		$this->setFont('Arial','',16);
		$this->Cell(0,5,Pengaturan::item('nama_rs'),0,0,'C');

		$this->setFont('Arial','',16);
		$this->Ln(7);
		$this->Cell(0,5,Pengaturan::item('nama_app'),0,0,'C');

		$this->setFont('Arial','',12);
		$this->Ln(6);
		$this->Cell(0,5,Pengaturan::item('alamat_rs'),0,0,'C');

		$y = $this->GetY()+7;

		$this->Line(5,$y,351,$y);

		$this->setFont('Arial','U',16);
		$this->Ln(10);
		$this->Cell(0,5,'LAPORAN RESPON TIME',0,0,'C');

		$this->setFont('Arial','',10);

		$this->Ln(5);
		$this->Cell(8,5,'Periode : '.$this->tawal.' s/d '.$this->takhir,0,0,'L');

		$this->SetX(-20);
		$this->Cell(10,5,'Hal : ',0,0,'L');
		$this->SetX(-12);
		$this->Cell(1,5,$this->PageNo().'/{nb}',0,0,'L');

		$this->Ln(5);
		$this->Cell(8,5,'No',1,0,'C');
		$this->Cell(28,5,'No. Lab',1,0,'C');
		$this->Cell(55,5,'Nama Pasien',1,0,'C');
		$this->Cell(10,5,'JK',1,0,'C');
		$this->Cell(51,5,'Tanggal Lahir',1,0,'C');
		$this->Cell(104,5,'Rujukan Dokter',1,0,'C');
		$this->Cell(60,5,'Petugas Lab',1,0,'C');
		$this->Cell(30,5,'Respon Time',1,0,'C');

		$this->SetAutoPageBreak(true, 5);

		if($this->PageNo()!=1){
			$this->Ln(5);
		}
	}

	function Report($awal,$akhir)
	{
		$this->Ln(5);
		$this->setwidths(array(8,28,55,10,51,104,60,30));
		$this->iscustomborder=True;
		$this->coldetailalign = array('C','C','L','C','C','L','L','L','C');
		$this->setbordercell(array('LR','LR','LR','LR','LR','LR','LR','LR','LR'));

		$awal = Parameter::tglMySQL($awal);
		$akhir = Parameter::tglMySQL($akhir);

		$sql = "SELECT a.id, a.nomor, b.no_bpjs, b.nama, b.gender, b.tgl_lahir, a.id_dokter, a.id_petugas FROM periksa a LEFT JOIN pasien b ON a.id_pasien=b.id WHERE DATE(a.tanggal) BETWEEN '$awal' AND '$akhir' AND a.state='1' AND validasi='1' ORDER BY a.nomor";

		$no=1;
		$model = Yii::app()->db->createCommand($sql)->queryAll();
		foreach ($model as $data){
			$y = $this->GetY();

				$this->row(array(
					$no,
					$data['nomor'],
					$data['nama'],
					Parameter::getGender($data['gender']),
					Parameter::tglIndo($data['tgl_lahir']).' ('.Pasien::umur2($data['tgl_lahir']).' Tahun)',
					Dokter::item($data['id_dokter']),
					Petugas::item($data['id_petugas']),
					Periksa::getResponTime($data['id'])
				));

			$no++;

			if($y == 195){
				$this->Line(5,205,351,205);
			}
		}

		$y = $this->GetY();
		$this->Line(5,$y,351,$y);
	}
}
?>