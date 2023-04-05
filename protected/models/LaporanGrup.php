<?php
class LaporanGrup extends LaporanPeriode
{

    public $awal;
    public $akhir;
    public $kode;
    public $nama;
    public $grup1;
    public $grup2;
    public $grup3;
    public $pilih;

    public function rules()
    {
        return array(
            array('awal, akhir, kode, nama, grup1, grup2, grup3, pilih', 'required'),
        );
    }

    public function attributeLabels()
    {
        return array(
            'awal' => 'Periode',
            'akhir' => 's/d',
            'pilih' => 'Cetak Berdasarkan Grup',
        );
    }

    public static function getGrup()
    {
        $gender = array(1 => "Grup1", "Grup2", "Grup3");

        return $gender;
    }
}
