<?php
class MyFile extends CFormModel {

    public $file;

    public function rules () {
        return array (
            array ('file', 'required'),
            array ('file', 'file', 'types' => 'sql'),
        );
    }

    public function attributeLabels()
	{
		return array(
			'file' => 'File',
		);
	}
}
?>