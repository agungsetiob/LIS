<?php
class CetakPasien0 extends pdf
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
		$this->Cell(0,5,'LAPORAN PASIEN',0,0,'C');

		$this->setFont('Arial','',16);

		$this->Ln(7);
		if($this->supplier==0){
			$this->Cell(0,5,'SEMUA',0,0,'C');
		} else {
			$this->Cell(0,5,Parameter::item("cStatePasien",$this->supplier),0,0,'C');
		}

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
		$this->Cell(25,5,'Tanggal Lahir',1,0,'C');
		$this->Cell(45,5,'Ruang',1,0,'C');
		$this->Cell(59,5,'Rujukan Dokter',1,0,'C');
		$this->Cell(35,5,'Petugas Lab',1,0,'C');
		$this->Cell(41,5,'Parameter',1,0,'C');
		$this->Cell(40,5,'Hasil',1,0,'C');

		$this->SetAutoPageBreak(true, 5);

		if($this->PageNo()!=1){
			$this->Ln(5);
		}
	}

	function Report($awal,$akhir,$penjamin)
	{
		$this->Ln(5);
		$this->setwidths(array(8,28,55,10,25,45,59,35,41,40));
		$this->iscustomborder=True;
		$this->coldetailalign = array('C','C','L','C','C','L','L','L','C','L');
		$this->setbordercell(array('LR','LR','LR','LR','LR','LR','LR','LR','LR','LR'));

		$awal = Parameter::tglMySQL($awal);
		$akhir = Parameter::tglMySQL($akhir);

		$sql = "SELECT a.nomor, b.no_bpjs, b.nama, b.gender, b.tgl_lahir, a.id_dokter, a.id_petugas, d.nama  AS parameter, c.Nilai, d.pembulatan, a.id_ruang FROM periksa a LEFT JOIN pasien b ON a.id_pasien=b.id LEFT JOIN result c ON a.nomor=c.KodePatient LEFT JOIN kode d ON c.KodeParamater=d.lis WHERE DATE(a.tanggal) BETWEEN '$awal' AND '$akhir' AND c.acc='1' AND a.state='1'";

		if($penjamin!=0){
			$sql .= " AND b.state='$penjamin'";
		}

		$sql .= " ORDER BY a.nomor";

		$no=1;
		$nomor="";
		$model = Yii::app()->db->createCommand($sql)->queryAll();
		foreach ($model as $data){
			$y = $this->GetY();

			if($data['pembulatan']==0){
				$nilai = round($data['Nilai']);
			}
			else if($data['pembulatan']==99){
				$nilai = $data['Nilai'];
			}
			else {
				$nilai = round($data['Nilai'],$data['pembulatan']);
			}

			if($nomor!=$data['nomor']){
				$this->row(array(
					$no,
					$data['nomor'],
					$data['nama'],
					Parameter::getGender($data['gender']),
					Parameter::tglIndo($data['tgl_lahir']).' ('.Pasien::umur2($data['tgl_lahir']).' Tahun)',
					Ruang::item($data['id_ruang']),
					Dokter::item($data['id_dokter']),
					Petugas::item($data['id_petugas']),
					$data['parameter'],
					$nilai,
				));

				$no++;
			} else {
				$this->row(array(
					'',
					'',
					'',
					'',
					'',
					'',
					'',
					'',
					
					$data['parameter'],
					$nilai,
				));
			}

			$nomor=$data['nomor'];

			if($y == 195){
				$this->Line(5,205,351,205);
			}
		}

		$y = $this->GetY();
		$this->Line(5,$y,351,$y);
	}
}
?>