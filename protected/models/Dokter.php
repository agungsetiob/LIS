<?php

/**
 * This is the model class for table "dokter".
 *
 * The followings are the available columns in table 'dokter':
 * @property integer $id
 * @property string $nama
 * @property string $nip
 * @property integer $kode
 */
class Dokter extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'dokter';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('nama, kode', 'required'),
			array('kode', 'numerical', 'integerOnly'=>true),
			array('nama', 'length', 'max'=>50),
			array('nip, id_dokter', 'length', 'max'=>25),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, nama, nip, kode', 'safe', 'on'=>'search'),
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
			'id_dokter' => 'ID Dokter',
			'nama' => 'Nama',
			'nip' => 'NIP',
			'kode' => 'Kode',
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
		$criteria->compare('id_dokter',$this->id_dokter,true);
		$criteria->compare('nama',$this->nama,true);
		$criteria->compare('nip',$this->nip,true);
		$criteria->compare('kode',$this->kode);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Dokter the static model class
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

	public static function items()
	{
		$_items=array();
		$models=self::model()->findAll(array('condition'=>'kode=:id','params'=>array(':id'=>'1'),'order'=>'nama'));

		foreach($models as $model)
				$_items[$model->id]=$model->nama;

		return $_items;
	}

	public static function items2()
	{
		$_items=array();
		if(Yii::app()->user->unit=='IGD'){
			$models=self::model()->findAll(array('condition'=>'id=:id','params'=>array(':id'=>'53'),'order'=>'nama'));
		} else {
			$models=self::model()->findAll(array('condition'=>'kode=:id','params'=>array(':id'=>'2'),'order'=>'nama'));
		}

		foreach($models as $model)
				$_items[$model->id]=$model->nama;

		return $_items;
	}

	public static function getIdDokter($id)
	{
		$model=self::model()->find(array('condition'=>'nama=:id','params'=>array(':id'=>$id),));
		return $model->id;
	}

	public static function getTtd($id)
	{
		$model=self::model()->find(array('condition'=>'id=:id','params'=>array(':id'=>$id),));
		return $model->ttd;
	}

	public static function getField($id,$field)
	{
		$sql = "SELECT * FROM dokter WHERE id='$id'";
		$model = Yii::app()->db->createCommand($sql)->queryRow();
		return $model[$field];
	}
}
