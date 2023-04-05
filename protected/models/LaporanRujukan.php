<?php
class LaporanRujukan extends CFormModel {
        
    public $awal;
    public $akhir;    
    public $dokter;    

    public function rules() {
        return array(
            array('awal, akhir, dokter', 'required'),
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