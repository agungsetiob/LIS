<?php
class CetakKunjungan1 extends fpdf
{
    function Header()
    {
        $this->Image('images/logo.png', 1, 0.8, 2.7);

        $this->setFont('Arial', '', 16);
        $this->Cell(0, 0.5, Pengaturan::item('nama_rs'), 0, 0, 'C');

        $this->setFont('Arial', '', 16);
        $this->Ln(0.7);
        $this->Cell(0, 0.5, Pengaturan::item('nama_app'), 0, 0, 'C');

        $this->setFont('Arial', '', 12);
        $this->Ln(0.6);
        $this->Cell(0, 0.5, Pengaturan::item('alamat_rs'), 0, 0, 'C');

        $y = $this->GetY() + 0.7;

        $this->Line(0.5, $y, 20.5, $y);

        $this->setFont('Arial', '', 12);
        $this->Ln(1);
        $this->Cell(0, 0.5, 'KUNJUNGAN PASIEN BERDASARKAN USIA', 0, 1, 'C');

        $this->setFont('Arial', '', 10);
        $this->Cell(0, 0.5, 'Periode : ' . $this->tawal . ' s/d ' . $this->takhir, 0, 0, 'C');

        $this->Ln(0.6);
        $this->Cell(1, 0.5, 'No', 1, 0, 'C');
        $this->Cell(9.5, 0.5, 'Usia', 1, 0, 'C');
        $this->Cell(9.5, 0.5, 'Jumlah', 1, 0, 'C');

        if ($this->PageNo() != 1) {
            $this->Ln(5);
        }
    }

    function Report($awal, $akhir)
    {
        $awal = Parameter::tglMySQL($awal);
        $akhir = Parameter::tglMySQL($akhir);
        
        $tahun = array(
            "1" => "< 1 Tahun",
            "2" => "1 - 13 Tahun",
            "3" => "14 - 40 Tahun",
            "4" => "41 - 60 Tahun",
            "5" => "> 61 Tahun",
        );

        $total = 0;
        foreach ($tahun as $key => $value) {
            $jumlah = Laporan::getKunjunganUsia($key, $awal, $akhir);

            $this->Ln(0.5);
            $this->Cell(1, 0.5, $key, 1, 0, 'C');
            $this->Cell(9.5, 0.5, $value, 1, 0, 'L');
            $this->Cell(9.5, 0.5, $jumlah, 1, 0, 'C');

            $total += $jumlah;
        }

        $this->Ln(0.5);
        $this->Cell(1, 0.5, '', 1, 0, 'C');
        $this->Cell(9.5, 0.5, 'Total', 1, 0, 'L');
        $this->Cell(9.5, 0.5, $total, 1, 0, 'C');
    }
}
