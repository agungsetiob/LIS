<?php
class CetakPasien4 extends fpdf
{
	function Header()
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

		$this->Line(0.5,$y,32.5,$y);

		$this->setFont('Arial','U',16);
		$this->Ln(1);
		$this->Cell(0,0.5,'LAPORAN PASIEN',0,0,'C');

		$this->setFont('Arial','',16);

		$this->Ln(0.7);
		$this->Cell(0,0.5,'WAKTU',0,0,'C');

		$this->setFont('Arial','',10);

		$this->Ln(0.5);
		$this->Cell(0.8,0.5,'Periode : '.$this->tawal.' s/d '.$this->takhir,0,0,'L');

		$this->SetX(-2);
		$this->Cell(1,0.5,'Hal : ',0,0,'L');
		$this->SetX(-1.2);
		$this->Cell(1,0.5,$this->PageNo().'/{nb}',0,0,'L');

		$this->Ln(0.5);
		$this->Cell(0.8,0.5,'No',1,0,'C');
		$this->Cell(2.8,0.5,'No. Lab',1,0,'C');		
		$this->Cell(5.5,0.5,'Nama Pasien',1,0,'L');
		$this->Cell(1,0.5,'JK',1,0,'C');
		$this->Cell(2,0.5,'Umur Thn',1,0,'C');
		$this->Cell(1.65,0.5,'Status',1,0,'C');
		$this->Cell(1.65,0.5,'Lama',1,0,'C');
		$this->Cell(5,0.5,'Rujukan Dokter',1,0,'L');
		$this->Cell(5,0.5,'Petugas Lab',1,0,'L');
		$this->Cell(3.1,0.5,'Parameter',1,0,'L');
		$this->Cell(1.5,0.5,'Hasil',1,0,'C');
		$this->Cell(2,0.5,'Harga',1,0,'R');

		if($this->PageNo()!=1){
			$this->Ln(0.5);
		}
	}

	function Report($awal,$akhir)
	{
		$awal = Parameter::tglMySQL($awal);
		$akhir = Parameter::tglMySQL($akhir);

		$sql = "SELECT a.nomor, b.state, b.gender, b.nama, b.gender, b.tgl_lahir, a.id_dokter, a.id_petugas FROM periksa a LEFT JOIN pasien b ON a.id_pasien=b.id WHERE DATE(tanggal) BETWEEN '$awal' AND '$akhir' AND a.state='1' ORDER BY a.nomor";
		$no=1;
		$grandtotal=0;
		$model = Yii::app()->db->createCommand($sql)->queryAll();
		foreach ($model as $data){
			$this->Ln(0.5);
			$this->Cell(0.8,0.5,$no,'LR',0,'C');
			$this->Cell(2.8,0.5,$data['nomor'],'LR',0,'C');			
			$this->Cell(5.5,0.5,$data['nama'],'LR',0,'L');
			$this->Cell(1,0.5,Parameter::getGender($data['gender']),'LR',0,'C');
			$this->Cell(2,0.5,Pasien::umur2($data['tgl_lahir']),'LR',0,'C');
			$this->Cell(1.65,0.5,Parameter::item("cStatePasien",$data['state']),'LR',0,'C');
			$this->Cell(1.65,0.5,'','LR',0,'C');
			$this->Cell(5,0.5,Dokter::item($data['id_dokter']),'LR',0,'L');
			$this->Cell(5,0.5,Petugas::item($data['id_petugas']),'LR',0,'L');

			$sql2 = "SELECT b.nama, a.Nilai, b.pembulatan, b.harga FROM result a LEFT JOIN kode b ON a.KodeParamater=b.lis WHERE a.KodePatient='$data[nomor]' AND acc='1'";
			$no2=1;
			$subtotal=0;
			$model2 = Yii::app()->db->createCommand($sql2)->queryAll();
			$jumlah=count($model2);
			if($jumlah!=0){
				foreach ($model2 as $data2) {

					$nilai = $data2['Nilai'];
					if($data2['pembulatan']==1){
						$nilai = round($data2['Nilai']);
					} else if($data2['pembulatan']==2){
						$nilai = round($data2['Nilai'],1);
					}
	
					if($no2!='1'){
						$this->Cell(0.8,0.5,'','LR',0,'C');
						$this->Cell(2.8,0.5,'','LR',0,'C');						
						$this->Cell(5.5,0.5,'','LR',0,'C');
						$this->Cell(1,0.5,'','LR',0,'C');
						$this->Cell(2,0.5,'','LR',0,'C');
						$this->Cell(1.65,0.5,'','LR',0,'C');
						$this->Cell(1.65,0.5,'','LR',0,'C');
						$this->Cell(5,0.5,'','LR',0,'C');
						$this->Cell(5,0.5,'','LR',0,'C');
					}
	
					$this->SetX(25.9);
	
					$this->Cell(3.1,0.5,$data2['nama'],'LR',0,'L');
					$this->Cell(1.5,0.5,$nilai,'LR',0,'C');
					$this->Cell(2,0.5,number_format($data2['harga']),'LR',0,'R');
					if($no2!=$jumlah){
						$this->Ln(0.5);
					}
					
					$no2++;
					$subtotal+=$data2['harga'];
				}
			} else {
				$this->Cell(3.1,0.5,'',1,0,'C');
				$this->Cell(1.5,0.5,'',1,0,'C');
				$this->Cell(2,0.5,'',1,0,'C');
			}

			if($jumlah!=0){
				$this->Ln(0.5);
				$this->Cell(0.8,0.5,'','LR',0,'C');
				$this->Cell(2.8,0.5,'','LR',0,'C');				
				$this->Cell(5.5,0.5,'','LR',0,'C');
				$this->Cell(1,0.5,'','LR',0,'C');
				$this->Cell(2,0.5,'','LR',0,'C');
				$this->Cell(1.65,0.5,'','LR',0,'C');
				$this->Cell(1.65,0.5,'','LR',0,'C');
				$this->Cell(5,0.5,'','LR',0,'C');
				$this->Cell(5,0.5,'','LR',0,'C');
				$this->Cell(3.1,0.5,'Sub Total',1,0,'L');
				$this->Cell(1.5,0.5,'',1,0,'C');
				$this->Cell(2,0.5,number_format($subtotal),1,0,'R');
			}
			
			$no++;
			$grandtotal+=$subtotal;
		}
		$this->Ln(0.5);
		$this->Cell(0.8,0.5,'','LRB',0,'C');
		$this->Cell(2.8,0.5,'','LRB',0,'C');		
		$this->Cell(5.5,0.5,'','LRB',0,'C');
		$this->Cell(1,0.5,'','LRB',0,'C');
		$this->Cell(2,0.5,'','LRB',0,'C');
		$this->Cell(1.65,0.5,'','LRB',0,'C');
		$this->Cell(1.65,0.5,'','LRB',0,'C');
		$this->Cell(5,0.5,'','LRB',0,'C');
		$this->Cell(5,0.5,'','LRB',0,'C');
		$this->Cell(3.1,0.5,'Grand Total',1,0,'L');
		$this->Cell(1.5,0.5,'',1,0,'C');
		$this->Cell(2,0.5,number_format($grandtotal),1,0,'R');
	}
}
?>