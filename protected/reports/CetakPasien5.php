<?php
class CetakPasien5 extends fpdf
{
	function Report($awal,$akhir,$id)
	{
		$this->Image('images/logo.png',1.6,0.8,2);

		$this->Ln(0.5);
		$this->setFont('Arial','',16);
		$this->Cell(0,0.5,Pengaturan::item('nama_rs'),0,0,'C');

		$this->setFont('Arial','',16);
		$this->Ln(0.7);
		$this->Cell(0,0.5,Pengaturan::item('nama_app'),0,0,'C');

		$this->setFont('Arial','',12);
		$this->Ln(0.6);
		$this->Cell(0,0.5,Pengaturan::item('alamat_rs'),0,0,'C');

		$y = $this->GetY()+0.7;

		$this->Line(0.5,$y,35.1,$y);

		$this->setFont('Arial','U',16);
		$this->Ln(1);
		$this->Cell(0,0.5,'LAPORAN REKAPITULASI PASIEN',0,0,'C');

		$this->setFont('Arial','',16);

		$pasien=Pasien::model()->findByPk($id);

		$this->Ln(0.7);
		$this->Cell(0,0.5,$pasien->nama.'; '.Parameter::getGender($pasien->gender).'; '.Pasien::umur2($pasien->tgl_lahir).' th',0,0,'C');

		$this->setFont('Arial','',10);

		$this->Ln(0.5);
		$this->Cell(0.8,0.5,'Periode : '.$awal.' s/d '.$akhir,0,0,'L');

		$this->SetX(-2);
		$this->Cell(1,0.5,'Hal : ',0,0,'L');
		$this->SetX(-1.2);
		$this->Cell(1,0.5,$this->PageNo().'/{nb}',0,0,'L');

		$this->Ln(0.5);
		$this->Cell(3.5,0.5,'Parameter',1,0,'C');

		$awal = Parameter::tglMySQL($awal);
		$akhir = Parameter::tglMySQL($akhir);

		$sql = "SELECT tanggal FROM periksa WHERE DATE(tanggal) BETWEEN '$awal' AND '$akhir' AND state='1' AND id_pasien='$id' GROUP BY nomor";
		$model = Yii::app()->db->createCommand($sql)->queryAll();
		foreach ($model as $data){
			$this->Cell(2.8,0.5,date("d/m/Y", strtotime($data['tanggal'])),1,0,'C');
		}

		$sql2 = "SELECT b.KodeParamater, c.nama, c.pembulatan FROM periksa a LEFT JOIN result b ON a.nomor=b.KodePatient LEFT JOIN kode c ON b.KodeParamater=c.lis WHERE a.id_pasien='$id' AND DATE(a.tanggal) BETWEEN '$awal' AND '$akhir' AND b.acc='1' GROUP BY b.KodeParamater";
		$model2 = Yii::app()->db->createCommand($sql2)->queryAll();
		foreach ($model2 as $data2){
			$this->Ln(0.5);
			$this->Cell(3.5,0.5,$data2['nama'],'LR',0,'L');

			$sql3 = "SELECT nomor FROM periksa WHERE DATE(tanggal) BETWEEN '$awal' AND '$akhir' AND state='1' AND id_pasien='$id' GROUP BY nomor";
			$model3 = Yii::app()->db->createCommand($sql3)->queryAll();
			foreach ($model3 as $data3){
				$this->Cell(2.8,0.5,Periksa::getRekapPemeriksaanPasien($data3['nomor'],$data2['KodeParamater'],$data2['pembulatan']),'LR',0,'L');
			}
		}

		$this->Ln(0.5);
		$this->Cell(3.5,0.5,'','T',0,'L');

		$sql3 = "SELECT nomor FROM periksa WHERE DATE(tanggal) BETWEEN '$awal' AND '$akhir' AND state='1' AND id_pasien='$id' GROUP BY nomor";
		$model3 = Yii::app()->db->createCommand($sql3)->queryAll();
		foreach ($model3 as $data3){
			$this->Cell(2.8,0.5,'','T',0,'L');
		}
	}
}
?>