<?php

/**
 * This is the model class for table "periksa_biaya".
 *
 * The followings are the available columns in table 'periksa_biaya':
 * @property integer $id
 * @property integer $periksa_id
 * @property integer $tarif_id
 * @property integer $qty
 * @property integer $tarif
 *
 * The followings are the available model relations:
 * @property Periksa $periksa
 * @property Tarif $tarif0
 */
class PeriksaBiaya extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'periksa_biaya';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id, periksa_id, tarif_id, tarif', 'required'),
			array('id, periksa_id, tarif_id, qty, tarif', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, periksa_id, tarif_id, qty, tarif', 'safe', 'on'=>'search'),
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
			'periksa' => array(self::BELONGS_TO, 'Periksa', 'periksa_id'),
			'tarif0' => array(self::BELONGS_TO, 'Tarif', 'tarif_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'periksa_id' => 'Periksa',
			'tarif_id' => 'Tarif',
			'qty' => 'Qty',
			'tarif' => 'Tarif',
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
		$criteria->compare('periksa_id',$this->periksa_id);
		$criteria->compare('tarif_id',$this->tarif_id);
		$criteria->compare('qty',$this->qty);
		$criteria->compare('tarif',$this->tarif);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return PeriksaBiaya the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
