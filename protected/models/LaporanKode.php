<?php
class LaporanKode extends LaporanPeriode {
        
    public $awal;
    public $akhir;  
    public $kode;    

    public function rules() {
        return array(
            array('awal, akhir, kode', 'required'),
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