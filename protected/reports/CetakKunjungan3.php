<?php
class CetakKunjungan3 extends fpdf
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
        $this->Cell(0, 0.5, 'KUNJUNGAN PASIEN BERDASARKAN ASAL PASIEN', 0, 1, 'C');

        $this->setFont('Arial', '', 10);
        $this->Cell(0, 0.5, 'Periode : ' . $this->tawal . ' s/d ' . $this->takhir, 0, 0, 'C');

        $this->Ln(0.6);
        $this->Cell(1, 0.5, 'No', 1, 0, 'C');
        $this->Cell(9.5, 0.5, 'Asal Pasien', 1, 0, 'C');
        $this->Cell(9.5, 0.5, 'Jumlah', 1, 0, 'C');

        if ($this->PageNo() != 1) {
            $this->Ln(5);
        }
    }

    function Report($awal, $akhir)
    {
        $model = Ruang::model()->findAll();

        $awal = Parameter::tglMySQL($awal);
        $akhir = Parameter::tglMySQL($akhir);

        $no = 1;
        $total = 0;
        foreach ($model as $data) {
            $jumlah = Laporan::getKunjunganAsal($data->id, $awal, $akhir);

            $this->Ln(0.5);
            $this->Cell(1, 0.5, $no, 1, 0, 'C');
            $this->Cell(9.5, 0.5, $data->nama, 1, 0, 'L');
            $this->Cell(9.5, 0.5, $jumlah, 1, 0, 'C');

            $no++;
            $total += $jumlah;
        }

        $this->Ln(0.5);
        $this->Cell(1, 0.5, '', 1, 0, 'C');
        $this->Cell(9.5, 0.5, 'Total', 1, 0, 'L');
        $this->Cell(9.5, 0.5, $total, 1, 0, 'C');
    }
}
