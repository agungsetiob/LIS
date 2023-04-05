<?php
class LaporanBulanTahun extends CFormModel {
        
    public $bulan;
    public $tahun;    

    public function rules() {
        return array(
            array('bulan, tahun', 'required'),
        );
    }

    public function attributeLabels() {
        return array(            
            'bulan' => 'Bulan',
            'tahun' => 'Tahun',            
        );
    }
}
?>