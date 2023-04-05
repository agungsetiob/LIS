<?php

/**
 * This is the model class for table "instansi".
 *
 * The followings are the available columns in table 'instansi':
 * @property integer $id
 * @property string $nama
 * @property string $alamat
 * @property string $telepon
 */
class Instansi extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'instansi';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('nama, alamat, telepon', 'required'),
			array('nama', 'length', 'max'=>100),
			array('alamat', 'length', 'max'=>255),
			array('telepon', 'length', 'max'=>30),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, nama, alamat, telepon', 'safe', 'on'=>'search'),
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
			'alamat' => 'Alamat',
			'telepon' => 'Telepon',
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
		$criteria->compare('alamat',$this->alamat,true);
		$criteria->compare('telepon',$this->telepon,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Instansi the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public static function item($id)
	{
		$model=self::model()->find(array('condition'=>'id=:id','params'=>array(':id'=>$id),));
		return $model->nama;
	}

	public static function items0()
	{
		$_items=array();
		$models=self::model()->findAll(array('order'=>'nama'));

		$_items[0]='Semua';
		foreach($models as $model)
				$_items[$model->id]=$model->nama;

		return $_items;
	}

	public static function items()
	{
		$_items=array();
		$models=self::model()->findAll(array('order'=>'nama'));

		$_items[0]='Pilih Instansi';
		foreach($models as $model)
				$_items[$model->id]=$model->nama;

		return $_items;
	}
}
