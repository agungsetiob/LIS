<?php

/**
 * This is the model class for table "pasien".
 *
 * The followings are the available columns in table 'pasien':
 * @property integer $id
 * @property string $no_rm
 * @property string $nama
 * @property string $tgl_lahir
 * @property string $alamat
 */
class Pasien extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'pasien';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('nama, tgl_lahir, gender, state', 'required'),
			array('id_instansi', 'numerical', 'integerOnly'=>true),
			array('no_rm, no_bpjs', 'length', 'max'=>50),
			array('nama, tempat_lahir', 'length', 'max'=>100),
			array('alamat', 'length', 'max'=>200),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, no_rm, nama, tgl_lahir, alamat', 'safe', 'on'=>'search'),
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
			'no_rm' => 'No RM',
			'nama' => 'Nama',
			'tgl_lahir' => 'Tanggal Lahir',
			'alamat' => 'Alamat',
			'gender' => 'Jenis Kelamin',
			'state' => 'Penjamin',
			'no_bpjs' => 'No BPJS',
			'id_instansi' => 'Instansi',
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

		$criteria->compare('no_rm',$this->no_rm,true);
		$criteria->compare('nama',$this->nama,true);
		$criteria->compare('tgl_lahir',$this->tgl_lahir,true);
		$criteria->compare('gender',$this->gender);
		$criteria->compare('alamat',$this->alamat,true);
		$criteria->compare('state',$this->state);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'sort'=>array(
				'defaultOrder'=>'id DESC',
			)
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Pasien the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function behaviors()
	{
		return array('datetimeI18NBehavior' => array('class' => 'ext.DateTimeI18NBehavior'));
	}

	public static function item($id)
	{
		$model=self::model()->find(array('condition'=>'id=:id','params'=>array(':id'=>$id),));
		return $model->nama;
	}

	public static function items()
	{
		$_items=array();
		$models=self::model()->findAll(array('order'=>'nama'));

		foreach($models as $model)
				$_items[$model->id]=$model->nama;

		return $_items;
	}

	public static function getPenjamin()
	{
		$_items=array();

		$sql = "SELECT b.state, c.nama FROM periksa a LEFT JOIN pasien b ON a.id_pasien=b.id LEFT JOIN parameter c ON b.state=c.id WHERE c.jenis='cStatePasien' GROUP BY b.state";
		$models = Yii::app()->db->createCommand($sql)->queryAll();

		$_items['0']='SEMUA';
		foreach($models as $model)
				$_items[$model['state']]=$model['nama'];

		return $_items;
	}

	public static function umur($tglmasuk) {
		$diff = abs(strtotime($tglmasuk) - time());
		$years = floor($diff / (365 * 60 * 60 * 24));
		$months = floor(($diff - $years * 365 * 60 * 60 * 24) / (30 * 60 * 60 * 24));
		$days = floor(($diff - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24) / (60 * 60 * 24));

		if ($years == 0 && $months == 0 )
		return $days . " Hari";
		elseif (!$years != 0 )
		return $months . " Bulan, " . $days . " Hari";
		else
		return $years . " Tahun " . $months . " Bulan";
	}

	public static function umur2($tglmasuk) {
		$diff = abs(strtotime($tglmasuk) - time());
		$years = floor($diff / (365 * 60 * 60 * 24));
		$months = floor(($diff - $years * 365 * 60 * 60 * 24) / (30 * 60 * 60 * 24));
		$days = floor(($diff - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24) / (60 * 60 * 24));

		return $years ;
	}
}
