<?php
class RubahPassword extends CFormModel {

    public $id;
    public $username;
    public $password;

    public function rules() {
        return array(
            array('username, password', 'required'),
            array('id', 'numerical', 'integerOnly'=>true),
        );
    }

    public function attributeLabels() {
        return array(
            'username' => 'Username',
            'password' => 'Password',
        );
    }
}
?>
