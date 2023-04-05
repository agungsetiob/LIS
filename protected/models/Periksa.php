<?php

/**
 * This is the model class for table "periksa".
 *
 * The followings are the available columns in table 'periksa':
 * @property integer $id
 * @property string $tanggal
 * @property string $nomor
 * @property integer $id_pasien
 * @property integer $id_dokter
 * @property integer $id_dokter2
 */
class Periksa extends CActiveRecord
{
	public $no_rm;

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'periksa';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('tanggal, nomor, id_pasien, id_dokter, id_dokter2, id_ruang, id_petugas, no_reg, id_paket', 'required'),
			array('id_pasien, id_dokter, id_dokter2, id_ruang, id_petugas, id_penjamin', 'numerical', 'integerOnly'=>true),
			array('nomor, unit, create_by, update_by, no_reg', 'length', 'max'=>50),
			array('seq', 'length', 'max'=>10),
			array('note', 'length', 'max'=>100),
			array('ket_klinik', 'length', 'max'=>30),
			array('create_at, update_at', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, tanggal, unit, nomor, no_rm, id_pasien, id_dokter, id_dokter2, no_reg, id_petugas, id_ruang, validasi, kritis, cetak', 'safe', 'on'=>'search'),
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
			'idPasien' => array(self::BELONGS_TO, 'Pasien', 'id_pasien'),
			'idDokter' => array(self::BELONGS_TO, 'Dokter', 'id_dokter'),
			'idPetugas' => array(self::BELONGS_TO, 'Petugas', 'id_petugas'),
			'idRuang' => array(self::BELONGS_TO, 'Ruang', 'id_ruang'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'tanggal' => 'Tanggal',
			'nomor' => 'Nomor',
			'id_pasien' => 'Pasien',
			'id_dokter' => 'Dokter Pengirim',
			'id_dokter2' => 'Dokter Penanggung Jawab',
			'id_ruang' => 'Ruangan',
			'id_petugas' => 'Petugas',
			'id_paket' => 'Paket',
			'no_reg' => 'No. Registrasi Lab',
			'ket_klinik' => 'Diagnosa',
			'id_penjamin' => 'Status Pasien'
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
	public function searchHasil()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->with=array('idPasien','idDokter','idRuang','idPetugas');
		$criteria->compare('t.state',1);
		$criteria->compare('t.validasi',1);
		// if(Yii::app()->user->id_dokter!='0'){
		// 	$criteria->compare('t.id_dokter2',Yii::app()->user->id_dokter);
		// }
		// if(Yii::app()->user->id!='1'){
		// 	$criteria->compare('unit',Yii::app()->user->unit);
		// }
		// if(Yii::app()->user->id_petugas!='0'){
		// 	$criteria->compare('t.id_petugas',Yii::app()->user->id_petugas);
		// }
		$criteria->compare('unit',$this->unit,true);
		$criteria->compare('nomor',$this->nomor,true);
		$criteria->compare('no_reg',$this->no_reg,true);
		$criteria->compare("DATE_FORMAT(tanggal, '%d-%m-%Y')", $this->tanggal, true);
		$criteria->compare('idPasien.no_rm',$this->no_rm,true);
		$criteria->compare('idPasien.nama',$this->id_pasien,true);
		$criteria->compare('idDokter.nama',$this->id_dokter,true);
		$criteria->compare('idRuang.nama',$this->id_ruang,true);
		$criteria->compare('idPetugas.nama',$this->id_petugas,true);
		$criteria->compare('validasi',$this->validasi);
		$criteria->compare('kritis',$this->kritis);
		$criteria->compare('cetak',$this->cetak);
		$criteria->compare('id_dokter2',$this->id_dokter2);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'sort'=>array(
				'defaultOrder'=>'t.id DESC',
			)
		));
	}

	public function searchVerifikasi()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->with=array('idPasien','idDokter','idRuang','idPetugas');
		$criteria->compare('t.state',1);
		$criteria->compare('t.validasi',0);
		$criteria->compare('unit',$this->unit,true);
		$criteria->compare('nomor',$this->nomor,true);
		$criteria->compare('no_reg',$this->no_reg,true);
		$criteria->compare("DATE_FORMAT(tanggal, '%d-%m-%Y')", $this->tanggal, true);
		$criteria->compare('idPasien.no_rm',$this->no_rm,true);
		$criteria->compare('idPasien.nama',$this->id_pasien,true);
		$criteria->compare('idDokter.nama',$this->id_dokter,true);
		$criteria->compare('idRuang.nama',$this->id_ruang,true);
		$criteria->compare('idPetugas.nama',$this->id_petugas,true);
		$criteria->compare('validasi',$this->validasi);
		$criteria->compare('kritis',$this->kritis);
		$criteria->compare('cetak',$this->cetak);
		$criteria->compare('id_dokter2',$this->id_dokter2);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'sort'=>array(
				'defaultOrder'=>'t.id DESC',
			)
		));
	}

	public function searchPending()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->with=array('idPasien','idDokter','idRuang');
		$criteria->compare('t.state',0);
		// if(Yii::app()->user->id!='1'){
		// 	$criteria->compare('unit',Yii::app()->user->unit);
		// }
		$criteria->compare('unit',$this->unit,true);
		$criteria->compare('nomor',$this->nomor,true);
		$criteria->compare("DATE_FORMAT(tanggal, '%d-%m-%Y')", $this->tanggal, true);
		$criteria->compare('idPasien.no_rm',$this->no_rm,true);
		$criteria->compare('idPasien.nama',$this->id_pasien,true);
		$criteria->compare('idDokter.nama',$this->id_dokter,true);
		$criteria->compare('id_dokter2',$this->id_dokter2);
		$criteria->compare('idRuang.nama',$this->id_ruang,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'sort'=>array(
				'defaultOrder'=>'t.id DESC',
			)
		));
	}

	public function searchBiaya()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->with=array('idPasien','idDokter','idRuang','idPetugas');
		if(Yii::app()->user->id_dokter!='0'){
			$criteria->compare('t.id_dokter2',Yii::app()->user->id_dokter);
		}
		if(Yii::app()->user->id!='1'){
			$criteria->compare('unit',Yii::app()->user->unit);
		}
		$criteria->compare('nomor',$this->nomor,true);
		$criteria->compare('no_reg',$this->no_reg,true);
		$criteria->compare("DATE_FORMAT(tanggal, '%d-%m-%Y')", $this->tanggal, true);
		$criteria->compare('idPasien.no_rm',$this->no_rm,true);
		$criteria->compare('idPasien.nama',$this->id_pasien,true);
		$criteria->compare('idDokter.nama',$this->id_dokter,true);
		$criteria->compare('idRuang.nama',$this->id_ruang,true);
		$criteria->compare('idPetugas.nama',$this->id_petugas,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'sort'=>array(
				'defaultOrder'=>'t.id DESC',
			)
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Periksa the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public static function getSeq()
	{
		$today = date("Y-m-d");

		$connection=Yii::app()->db;
		$sql = "SELECT max(seq) AS seq FROM periksa WHERE DATE(tanggal)='$today'";
	  	$data = $connection->createCommand($sql)->queryRow();

		$noUrut = (int) substr($data['seq'], -4);
		$noUrut++;
		$newID = sprintf("%04s", $noUrut);
		return $newID;
	}

	public static function getPending()
	{
		// if(Yii::app()->user->id!='1'){
		// 	$model=self::model()->findAll(array('condition'=>'state=:id AND unit=:unit','params'=>array(':id'=>0,':unit'=>Yii::app()->user->unit),));
		// } else {
			$model=self::model()->findAll(array('condition'=>'state=:id','params'=>array(':id'=>0),));
		// }
		return count($model);
	}

	public static function getAll()
	{
		$model=self::model()->findAll();
		return count($model);
	}

	public static function getRekapPemeriksaanPasien($nomor,$parameter,$pembulatan)
	{
		$sql = "SELECT a.Nilai FROM result a LEFT JOIN kode b ON a.KodeParamater=b.lis WHERE a.KodePatient='$nomor' AND a.KodeParamater='$parameter' AND a.acc='1'";
		$data = Yii::app()->db->createCommand($sql)->queryRow();
		if($pembulatan==0){
			$nilai = round($data['Nilai']);
		}
		else if($pembulatan==99){
			$nilai = $data['Nilai'];
		}
		else {
			$nilai = round($data['Nilai'],$pembulatan);
		}

		return $nilai;
	}

	public static function getResponTime($id)
	{
		$sql = "SELECT timediff(selesai, tanggal) AS respon_time, state FROM periksa WHERE id='$id'";
		$data = Yii::app()->db->createCommand($sql)->queryRow();
		if($data['state']==1)
			return $data['respon_time'];
		else
			return '';
	}

	public static function getResponTimeHour($id,$namaPetugas)
	{
		$sql = "SELECT TIMESTAMPDIFF(HOUR, tanggal, selesai) AS respon_time FROM periksa WHERE id='$id'";
		$data = Yii::app()->db->createCommand($sql)->queryRow();
		if($data['respon_time']>1)
			return $namaPetugas." <span class='label label-danger'><i class='fa fa-clock-o'></i></span>";
		else
			return $namaPetugas;
	}

	public static function getJumlahPeriksa($tanggal)
	{
		$sql = "SELECT COUNT(id) AS total FROM periksa WHERE DATE(tanggal) = '$tanggal' AND state != 3";
		$data = Yii::app()->db->createCommand($sql)->queryRow();
		return $data['total'];
	}

	public static function getStateJumlahPeriksa($tanggal, $jenis)
	{
		if($jenis == 1) {
			$sql = "SELECT COUNT(id) AS total FROM periksa WHERE DATE(tanggal) = '$tanggal' AND state = 0";
		} else if($jenis == 2) {
			$sql = "SELECT COUNT(id) AS total FROM periksa WHERE DATE(tanggal) = '$tanggal' AND state = 1 AND validasi = 0";
		} else if($jenis == 3) {
			$sql = "SELECT COUNT(id) AS total FROM periksa WHERE DATE(tanggal) = '$tanggal' AND state = 1 AND validasi = 1";
		}

		$data = Yii::app()->db->createCommand($sql)->queryRow();
		return $data['total'];
	}
}
