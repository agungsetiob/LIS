<?php

/**
 * This is the model class for table "kode_kritis".
 *
 * The followings are the available columns in table 'kode_kritis':
 * @property integer $id
 * @property integer $id_kode
 * @property integer $sex
 * @property integer $umur1
 * @property integer $umur2
 * @property integer $waktu
 * @property string $nk1
 * @property string $nk2
 */
class KodeKritis extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'kode_kritis';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_kode, nk1, nk2', 'required'),
			array('id_kode, sex, umur1, umur2, waktu', 'numerical', 'integerOnly'=>true),
			array('nk1, nk2', 'length', 'max'=>10),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, id_kode, sex, umur1, umur2, waktu, nk1, nk2', 'safe', 'on'=>'search'),
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
			'id_kode' => 'Id Kode',
			'sex' => 'Sex',
			'umur1' => 'Umur1',
			'umur2' => 'Umur2',
			'waktu' => 'Waktu',
			'nk1' => 'Nk1',
			'nk2' => 'Nk2',
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
		$criteria->compare('id_kode',$this->id_kode);
		$criteria->compare('sex',$this->sex);
		$criteria->compare('umur1',$this->umur1);
		$criteria->compare('umur2',$this->umur2);
		$criteria->compare('waktu',$this->waktu);
		$criteria->compare('nk1',$this->nk1,true);
		$criteria->compare('nk2',$this->nk2,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return KodeKritis the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
