<?php
class LaporanPeriodePenjamin extends CFormModel {
        
    public $awal;
    public $akhir;    
    public $penjamin;    

    public function rules() {
        return array(
            array('awal, akhir, penjamin', 'required'),
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