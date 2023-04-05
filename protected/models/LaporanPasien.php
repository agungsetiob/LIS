<?php
class LaporanPasien extends LaporanPeriode {
        
    public $awal;
    public $akhir;  
    public $pasien;    

    public function rules() {
        return array(
            array('awal, akhir, pasien', 'required'),
        );
    }    

    public function attributeLabels() {
        return array(            
            'awal' => 'Periode',
            'akhir' => 's/d',            
        );
    }
}
?>