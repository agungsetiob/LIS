<?php

/**
 * This is the model class for table "v_result".
 *
 * The followings are the available columns in table 'v_result':
 * @property string $KodePatient
 * @property string $KodeAlat
 * @property string $tgl
 */
class VResult extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'v_result';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('KodePatient, KodeAlat', 'required'),
			array('KodePatient, KodeAlat', 'length', 'max' => 100),
			array('tgl', 'length', 'max' => 21),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('KodePatient, KodeAlat, tgl', 'safe', 'on' => 'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array();
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'KodePatient' => 'No Sampel',
			'KodeAlat' => 'Alat',
			'tgl' => 'Tanggal',
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

		$criteria = new CDbCriteria;

		$criteria->compare('KodePatient', $this->KodePatient, true);
		$criteria->compare('KodeAlat', $this->KodeAlat, true);
		$criteria->compare('tgl', $this->tgl, true);

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return VResult the static model class
	 */
	public static function model($className = __CLASS__)
	{
		return parent::model($className);
	}

	public static function alat()
	{
		$_items = array();
		$sql = "SELECT KodeAlat FROM v_result GROUP BY KodeAlat";
        $models = Yii::app()->db->createCommand($sql)->queryAll();

		foreach ($models as $model)
			$_items[$model['KodeAlat']] = $model['KodeAlat'];

		return $_items;
	}
}
