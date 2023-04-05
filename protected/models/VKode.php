<?php

/**
 * This is the model class for table "v_kode".
 *
 * The followings are the available columns in table 'v_kode':
 * @property string $lis
 * @property integer $id
 * @property integer $id_kode
 * @property string $keterangan
 * @property integer $case
 * @property integer $sex
 * @property integer $umur1
 * @property integer $range1
 * @property integer $umur2
 * @property integer $waktu
 * @property string $nr1
 * @property integer $range2
 * @property string $nr2
 * @property string $nr
 */
class VKode extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'v_kode';
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return VKode the static model class
	 */
	public static function model($className = __CLASS__)
	{
		return parent::model($className);
	}

	public static function getField($lis, $parameter, $waktu, $sex, $field)
	{
		if ($parameter == 0) {
			//Tanpa Parameter
			$sql = "SELECT * FROM v_kode WHERE lis='$lis'";
			$data = Yii::app()->db->createCommand($sql)->queryRow();
			return $data[$field];
		} else if ($parameter == 1) {
			//Jenis Kelamin
			$sql = "SELECT * FROM v_kode WHERE lis='$lis' AND sex='$sex'";
			$data = Yii::app()->db->createCommand($sql)->queryRow();
			return $data[$field];
		} else if ($parameter == 2) {
			//Umur
			$sql = "SELECT * FROM v_kode WHERE lis='$lis' AND umur1 <= '$waktu' AND umur2 >= '$waktu'";
			$data = Yii::app()->db->createCommand($sql)->queryRow();
			return $data[$field];
		} else if ($parameter == 3) {
			//Jenis Kelamin & Umur
			$sql = "SELECT * FROM v_kode WHERE lis='$lis' AND sex='$sex' AND umur1 <= '$waktu' AND umur2 >= '$waktu'";
			$data = Yii::app()->db->createCommand($sql)->queryRow();
			return $data[$field];
		} else if ($parameter == 4) {
			//Sama Dengan
			$sql = "SELECT * FROM v_kode WHERE lis='$lis'";
			$data = Yii::app()->db->createCommand($sql)->queryRow();
			return $data[$field];
		} else if ($parameter == 99) {
			//None
			$sql = "SELECT * FROM v_kode WHERE lis='$lis'";
			$data = Yii::app()->db->createCommand($sql)->queryRow();
			return $data[$field];
		} else {
			return "";
		}
	}

	public static function getFlag($lis, $parameter, $waktu, $sex, $nilai)
	{
		if ($parameter == 0) {
			//Tanpa Parameter
			$sql = "SELECT * FROM v_kode WHERE lis='$lis'";
			$data = Yii::app()->db->createCommand($sql)->queryRow();
			if ($data['nr1'] != '') {
				if ($nilai >= $data['nr1'] and $nilai <= $data['nr2']) {
					return '';
				} else if ($data['nr1'] == 0.00 and $data['nr2'] == 0.00) {
					return '';
				} else if ($nilai < $data['nr1']) {
					return 'L';
				} else if ($nilai > $data['nr1']) {
					return 'H';
				}
			} else {
				return '';
			}
		} else if ($parameter == 1) {
			//Jenis Kelamin
			$sql = "SELECT * FROM v_kode WHERE lis='$lis' AND sex='$sex'";
			$data = Yii::app()->db->createCommand($sql)->queryRow();
			if ($data['nr1'] != '') {
				if ($nilai >= $data['nr1'] and $nilai <= $data['nr2']) {
					return '';
				} else if ($data['nr1'] == 0.00 and $data['nr2'] == 0.00) {
					return '';
				} else if ($nilai < $data['nr1']) {
					return 'L';
				} else if ($nilai > $data['nr1']) {
					return 'H';
				}
			} else {
				return '';
			}
		} else if ($parameter == 2) {
			//Umur
			$sql = "SELECT * FROM v_kode WHERE lis='$lis' AND umur1 <= '$waktu' AND umur2 >= '$waktu'";
			$data = Yii::app()->db->createCommand($sql)->queryRow();
			if ($data['nr1'] != '') {
				if ($nilai >= $data['nr1'] and $nilai <= $data['nr2']) {
					return '';
				} else if ($data['nr1'] == 0.00 and $data['nr2'] == 0.00) {
					return '';
				} else if ($nilai < $data['nr1']) {
					return 'L';
				} else if ($nilai > $data['nr1']) {
					return 'H';
				}
			} else {
				return '';
			}
		} else if ($parameter == 3) {
			//Jenis Kelamin & Umur
			$sql = "SELECT * FROM v_kode WHERE lis='$lis' AND sex='$sex' AND umur1 <= '$waktu' AND umur2 >= '$waktu'";
			$data = Yii::app()->db->createCommand($sql)->queryRow();
			if ($data['nr1'] != '') {
				if ($nilai >= $data['nr1'] and $nilai <= $data['nr2']) {
					return '';
				} else if ($data['nr1'] == 0.00 and $data['nr2'] == 0.00) {
					return '';
				} else if ($nilai < $data['nr1']) {
					return 'L';
				} else if ($nilai > $data['nr1']) {
					return 'H';
				}
			} else {
				return '';
			}
		} else if ($parameter == 4) {
			//Sama Dengan
			$sql = "SELECT * FROM v_kode WHERE lis='$lis'";
			$data = Yii::app()->db->createCommand($sql)->queryRow();
			if ($data['nr1'] != '') {
				if (trim($nilai) == trim($data['nr'])) {
					return '';
				} else if ($data['nr1'] == 0.00 and $data['nr2'] == 0.00) {
					return '';
				} else {
					return '*';
				}
			} else {
				return '';
			}
		} else {
			return "";
		}
	}

	public static function getKritis($lis, $parameter, $waktu, $sex, $nilai)
	{
		if ($parameter == 0) {
			//Tanpa Parameter
			$sql = "SELECT * FROM v_kode_kritis WHERE lis='$lis'";
			$data = Yii::app()->db->createCommand($sql)->queryRow();
			if ($data['nk1'] != '') {
				if ($data['nk1'] == '0.00') {
					return '';
				} else {
					if ($nilai < $data['nk1']) {
						return '#';
					} else if ($nilai > $data['nk2']) {
						return '#';
					}
				}
			} else {
				return '';
			}
		} else if ($parameter == 1) {
			//Jenis Kelamin
			$sql = "SELECT * FROM v_kode_kritis WHERE lis='$lis' AND sex='$sex'";
			$data = Yii::app()->db->createCommand($sql)->queryRow();
			if ($data['nk1'] != '') {
				if ($data['nk1'] == '0.00') {
					return '';
				} else {
					if ($nilai < $data['nk1']) {
						return '#';
					} else if ($nilai > $data['nk2']) {
						return '#';
					}
				}
			} else {
				return '';
			}
		} else if ($parameter == 2) {
			//Umur
			// $sql = "SELECT * FROM v_kode_kritis WHERE lis='$lis' AND waktu='$waktu'";
			$sql = "SELECT * FROM v_kode_kritis WHERE lis='$lis' AND umur1 <= '$waktu' AND umur2 >= '$waktu'";
			$data = Yii::app()->db->createCommand($sql)->queryRow();
			if ($data['nk1'] != '') {
				if ($data['nk1'] == '0.00') {
					return '';
				} else {
					if ($nilai < $data['nk1']) {
						return '#';
					} else if ($nilai > $data['nk2']) {
						return '#';
					}
				}
			} else {
				return '';
			}
		} else if ($parameter == 3) {
			//Jenis Kelamin & Umur
			// $sql = "SELECT * FROM v_kode_kritis WHERE lis='$lis' AND sex='$sex' AND waktu='$waktu'";
			$sql = "SELECT * FROM v_kode_kritis WHERE lis='$lis' AND sex='$sex' AND umur1 <= '$waktu' AND umur2 >= '$waktu'";
			$data = Yii::app()->db->createCommand($sql)->queryRow();
			if ($data['nk1'] != '') {
				if ($data['nk1'] == '0.00') {
					return '';
				} else {
					if ($nilai < $data['nk1']) {
						return '#';
					} else if ($nilai > $data['nk2']) {
						return '#';
					}
				}
			} else {
				return '';
			}
		} else if ($parameter == 4) {
			//Sama Dengan
			$sql = "SELECT * FROM v_kode_kritis WHERE lis='$lis'";
			$data = Yii::app()->db->createCommand($sql)->queryRow();
			if ($data['nk1'] != '') {
				if ($data['nk1'] == '0.00') {
					return '';
				} else {
					if ($nilai < $data['nk1']) {
						return '#';
					} else if ($nilai > $data['nk2']) {
						return '#';
					}
				}
			} else {
				return '';
			}
		} else {
			return '';
		}
	}
}
