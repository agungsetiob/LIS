<?php
class LaporanMcu extends LaporanPeriode {
        
    public $instansi;    

    public function rules() {
        return array(
            array('instansi', 'required'),
        );
    }    
}
?>