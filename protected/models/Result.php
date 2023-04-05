<?php

/**
 * This is the model class for table "result".
 *
 * The followings are the available columns in table 'result':
 * @property integer $id
 * @property string $KodePatient
 * @property string $KodeAlat
 * @property string $KodeParamater
 * @property string $Nilai
 */
class Result extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'result';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('KodePatient, KodeAlat, KodeParamater, Nilai', 'required'),
			array('KodePatient, KodeAlat, KodeParamater, Nilai', 'length', 'max'=>100),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, KodePatient, KodeAlat, KodeParamater, Nilai', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'KodePatient' => 'ID Lab',
			'KodeAlat' => 'Kode Alat',
			'KodeParamater' => 'Paramater',
			'Nilai' => 'Nilai',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('KodePatient',$this->KodePatient,true);
		$criteria->compare('KodeAlat',$this->KodeAlat,true);
		$criteria->compare('KodeParamater',$this->KodeParamater,true);
		$criteria->compare('Nilai',$this->Nilai,true);
		$criteria->order = "id DESC";

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Result the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public static function getGrupAcc($nomor,$grup)
	{
		$sql = "SELECT COUNT(*) AS jumlah FROM result a LEFT JOIN kode b ON a.KodeParamater=b.lis WHERE a.KodePatient LIKE '%$nomor%' AND b.grup1='$grup' AND acc='0'";
		$data = Yii::app()->db->createCommand($sql)->queryRow();

		return $data['jumlah'];;
	}

	public static function getTotalRiwayat($kodeParamater, $idPasien, $id)
	{
		$sql = "SELECT count(a.KodeParamater) AS jumlah FROM result a LEFT JOIN periksa b ON a.KodePatient=b.nomor WHERE a.KodeParamater='$kodeParamater' AND b.id_pasien='$idPasien' AND b.id<'$id' AND a.acc='1'";
		$data = Yii::app()->db->createCommand($sql)->queryRow();

		return $data['jumlah'];;
	}

	public static function getTotalResult($KodePatient)
	{
		$sql = "SELECT COUNT(*) AS total, KodePatient FROM result WHERE KodePatient LIKE '%$KodePatient%'";
		$data = Yii::app()->db->createCommand($sql)->queryRow();

		$nomor = $data['KodePatient'].' '."<span class='label label-success'>".$data['total']."</span>";

		if($data['total']!=0){
			return $nomor;
		} else {
			return $KodePatient;
		}
		
	}

	public static function jumlahPeriksa($KodePatient, $KodeParamater)
	{
		$data = Yii::app()->db->createCommand("SELECT COUNT(*) AS total FROM result WHERE KodePatient = '$KodePatient' AND KodeParamater='$KodeParamater'")->queryRow();

		return $data['total'];
	}

	public static function getTanggal($tanggal)
	{
		if($tanggal == "0000-00-00 00:00:00" or $tanggal == null) {
			return "";
		} else {
			return date("d.m.y H.i.s", strtotime($tanggal));
		}
	}

	public static function getNilai($KodePatient, $KodeParamater)
	{
		$sql = "SELECT Nilai FROM result WHERE KodePatient='$KodePatient' AND KodeParamater='$KodeParamater' AND acc='1'";
		$data = Yii::app()->db->createCommand($sql)->queryRow();

		return$data['Nilai'];
	}
}
