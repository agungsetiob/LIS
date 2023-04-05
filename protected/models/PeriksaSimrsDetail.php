<?php

/**
 * This is the model class for table "periksa_simrs_detail".
 *
 * The followings are the available columns in table 'periksa_simrs_detail':
 * @property integer $id
 * @property string $no_lab
 * @property string $grup
 * @property string $kode
 * @property string $nama
 * @property string $lis
 */
class PeriksaSimrsDetail extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'periksa_simrs_detail';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('no_lab, grup, kode, nama, lis', 'required'),
			array('no_lab, grup, kode, nama, lis', 'length', 'max'=>50),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, no_lab, grup, kode, nama, lis', 'safe', 'on'=>'search'),
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
			'no_lab' => 'No Lab',
			'grup' => 'Grup',
			'kode' => 'Kode',
			'nama' => 'Nama',
			'lis' => 'Lis',
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

		$criteria->compare('id',$this->id);
		$criteria->compare('no_lab',$this->no_lab,true);
		$criteria->compare('grup',$this->grup,true);
		$criteria->compare('kode',$this->kode,true);
		$criteria->compare('nama',$this->nama,true);
		$criteria->compare('lis',$this->lis,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return PeriksaSimrsDetail the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public static function getField($noLab, $lis, $col)
	{
		$sql = "SELECT * FROM periksa_simrs_detail WHERE no_lab = '$noLab' AND lis = '$lis'";
		$model = Yii::app()->db->createCommand($sql)->queryRow();
		return $model[$col];
	}
}
