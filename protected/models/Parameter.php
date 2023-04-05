<?php

/**
 * This is the model class for table "parameter".
 *
 * The followings are the available columns in table 'parameter':
 * @property string $jenis
 * @property integer $id
 * @property string $nama
 */
class Parameter extends CActiveRecord
{
	private static $_items=array();
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Parameter the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'parameter';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('jenis, id, nama', 'required'),
			array('id', 'numerical', 'integerOnly'=>true),
			array('jenis, nama', 'length', 'max'=>128),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('jenis, id, nama', 'safe', 'on'=>'search'),
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
			'jenis' => 'Jenis',
			'id' => 'ID',
			'nama' => 'Nama Parameter',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('jenis',$this->jenis,true);
		$criteria->group='jenis';

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	public function search2($id)
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('jenis',$id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'pagination'=>false,
		));
	}

	public static function items($type)
	{
		if(!isset(self::$_items[$type]))
			self::loadItems($type);
		return self::$_items[$type];
	}

		public static function items2($type)
	{
		if(!isset(self::$_items[$type]))
			self::loadItems2($type);
		return self::$_items[$type];
	}

	/**
	 * Returns the item name for the specified type and code.
	 * @param string the item type (e.g. 'PostStatus').
	 * @param integer the item code (corresponding to the 'code' column value)
	 * @return string the item name for the specified the code. False is returned if the item type or code does not exist.
	 */
	public static function item($type,$code)
	{
		if($code!=null){
			if(!isset(self::$_items[$type]))
				self::loadItems($type);
			return isset(self::$_items[$type][$code]) ? self::$_items[$type][$code] : false;
		}
		else {
			return "";
		}
	}

	public static function item2($type,$id)
	{
		if($id!=0){
			$model=self::model()->find(array(
				'condition'=>'jenis=:type AND id=:id',
				'params'=>array(':type'=>$type,':id'=>$id),
				'order'=>'id',
			));

			return $model->keterangan;
		} else {
			return "";
		}

	}

	/**
	 * Loads the lookup items for the specified type from the database.
	 * @param string the item type
	 */
	private static function loadItems($type)
	{
		self::$_items[$type]=array();
		$models=self::model()->findAll(array(
			'condition'=>'jenis=:type',
			'params'=>array(':type'=>$type),
			'order'=>'id',
		));
		foreach($models as $model)
			self::$_items[$type][$model->id]=$model->nama;
	}

	private static function loadItemss($type)
	{
		self::$_items[$type]=array();
		$models=self::model()->findAll(array(
			'condition'=>'jenis=:type',
			'params'=>array(':type'=>$type),
			'order'=>'id',
		));
		foreach($models as $model)
			self::$_items[$type][$model->id]=$model->keterangan;
	}

	private static function loadItems2($type)
	{
		self::$_items[$type]=array();
		$models=self::model()->findAll(array(
			'condition'=>'jenis=:type',
			'params'=>array(':type'=>$type),
			'order'=>'id',
		));

		foreach($models as $model)
			self::$_items[$type][$model->nama]=$model->nama;
	}

	public static function getItems($jenis)
	{
		$models=self::model()->findAll(array(
			'condition'=>'jenis=:type',
			'params'=>array(':type'=>$jenis),
			'order'=>'id',
		));

		return $models;
	}

	public static function tglMySQL($tgl)
	{
		return Yii::app()->dateFormatter->format('yyyy-MM-dd',CDateTimeParser::parse($tgl, 'dd-MM-yyyy'));
	}

	public static function getGender($id)
	{
		$gender = array(1=>"L","P");

        return $gender[$id];
	}

	public static function getGenderSIMRS($gender){
        $data = array("L"=>1,"P"=>2);
        return $data[$gender];
	}

	public static function getKeteranganSIMRS($jenis,$keterangan,$field){
		$sql = "SELECT * FROM parameter WHERE jenis = '$jenis' AND keterangan='$keterangan'";
		$data = Yii::app()->db->createCommand($sql)->queryRow();
		return $data[$field];
	}
	
	public static function tglIndo($tgl)
	{
		return Yii::app()->dateFormatter->format('dd-MM-yyyy',CDateTimeParser::parse($tgl, 'yyyy-MM-dd'));
	}

	public static function getStatusValidasi($id)
	{
		$status = array("","<span class='label label-success'><i class='fa fa-check'></i></span>");

        return $status[$id];
	}

	public static function getStatusKritis($id)
	{
		$status = array("","<span class='label label-danger'>!</span>");

        return $status[$id];
	}

	public static function getStatusCetak($id)
	{
		$status = array("","<span class='label label-primary'><i class='fa fa-print'></i></span>");

        return $status[$id];
	}

	public static function getBulan($tanggal){
		$bulan = date('n', strtotime($tanggal));
		$bulanList = array(1 => 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember');
		return $bulanList[$bulan];
	}

	public static function tanggalLengkap($tgl)
	{
		return date("d", strtotime($tgl)) . ' ' . self::getBulan($tgl) . ' ' . date("Y", strtotime($tgl));
	}
}
