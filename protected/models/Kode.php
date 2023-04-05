<?php

/**
 * This is the model class for table "kode".
 *
 * The followings are the available columns in table 'kode':
 * @property integer $id
 * @property string $nama
 * @property string $lis
 * @property string $satuan
 * @property string $grup1
 * @property string $grup2
 * @property string $grup3
 * @property string $metoda
 */
class Kode extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'kode';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('nama, lis', 'required'),
			array('parameter, pembulatan, order', 'numerical', 'integerOnly'=>true),
			array('nama', 'length', 'max'=>100),
			array('lis, satuan, grup1, grup2, grup3, metoda', 'length', 'max'=>50),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, nama, lis, satuan, grup1, grup2, grup3, metoda', 'safe', 'on'=>'search'),
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
			'nama' => 'Nama',
			'lis' => 'LIS',
			'satuan' => 'Satuan',
			'grup1' => 'Grup',
			'grup2' => 'Grup2',
			'grup3' => 'Grup3',
			'metoda' => 'Metode',
			'pembulatan' => 'Decimal',
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

		$criteria->compare('nama',$this->nama,true);
		$criteria->compare('lis',$this->lis,true);
		$criteria->compare('satuan',$this->satuan,true);
		$criteria->compare('grup1',$this->grup1,true);
		$criteria->compare('metoda',$this->metoda,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}


	public function searchManual()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('nama',$this->nama,true);
		$criteria->compare('lis',$this->lis,true);
		$criteria->compare('satuan',$this->satuan,true);
		$criteria->compare('grup1',$this->grup1,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Kode the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public static function item($id)
	{
		$model=self::model()->findByPk($id);
		return $model->nama;
	}

	public static function getLis($id)
	{
		$model=self::model()->findByPk($id);
		return $model->lis;
	}

	public static function getField($id,$field)
	{
		$sql = "SELECT * FROM kode WHERE id='$id'";
		$model = Yii::app()->db->createCommand($sql)->queryRow();
		return $model[$field];
	}

	public static function getFieldByLis($lis,$field)
	{
		$sql = "SELECT * FROM kode WHERE lis='$lis'";
		$model = Yii::app()->db->createCommand($sql)->queryRow();
		return $model[$field];
	}
}
