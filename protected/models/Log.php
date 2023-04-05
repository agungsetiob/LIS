<?php

/**
 * This is the model class for table "log".
 *
 * The followings are the available columns in table 'log':
 * @property integer $id_log
 * @property integer $id_user
 * @property string $kode
 * @property string $keterangan
 * @property string $tanggal
 * @property string $ip
 *
 * The followings are the available model relations:
 * @property User $idUser
 */
class Log extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'log';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_user, keterangan, tanggal, ip', 'required'),
			array('id_user', 'numerical', 'integerOnly' => true),
			array('ip', 'length', 'max' => 25),
			array('kode, keterangan', 'length', 'max' => 200),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_log, id_user, kode, keterangan, tanggal, ip', 'safe', 'on' => 'search'),
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
			'idUser' => array(self::BELONGS_TO, 'User', 'id_user'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_log' => 'Id Log',
			'id_user' => 'Id User',
			'kode' => 'Kode',
			'keterangan' => 'Keterangan',
			'tanggal' => 'Tanggal',
			'ip' => 'IP',
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

		$criteria->with = array('idUser');
		$criteria->compare('idUser.nama', $this->id_user, true);
		$criteria->compare('kode', $this->kode, true);
		$criteria->compare('keterangan', $this->keterangan, true);
		$criteria->compare('tanggal', $this->tanggal, true);
		$criteria->compare('ip', $this->ip, true);

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
			'sort' => array(
				'defaultOrder' => 't.id_log DESC',
			)
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Log the static model class
	 */
	public static function model($className = __CLASS__)
	{
		return parent::model($className);
	}
}
