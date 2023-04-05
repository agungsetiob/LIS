<?php
class LaporanPeriode extends CFormModel {
        
    public $awal;
    public $akhir;    

    public function rules() {
        return array(
            array('awal, akhir', 'required'),
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