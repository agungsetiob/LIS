<?php

/**
 * This is the model class for table "ruang".
 *
 * The followings are the available columns in table 'ruang':
 * @property integer $id
 * @property string $nama
 */
class Ruang extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'ruang';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('nama', 'required'),
			array('nama', 'length', 'max'=>50),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, nama', 'safe', 'on'=>'search'),
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
		$criteria->compare('nama',$this->nama,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Ruang the static model class
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

	public static function getIdRuang($id)
	{
		$model=self::model()->find(array('condition'=>'poli_id=:id','params'=>array(':id'=>$id),));
		return $model->id;
	}

	public static function items()
	{
		$_items=array();
		if(Yii::app()->user->unit=='IGD'){
			$models=self::model()->findAll(array('condition'=>'id=:id','params'=>array(':id'=>'218'),'order'=>'nama'));
		} else {
			$models=self::model()->findAll(array('order'=>'nama'));
		}

		foreach($models as $model)
				$_items[$model->id]=$model->nama;

		return $_items;
	}
}
