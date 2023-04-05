<?php

/**
 * This is the model class for table "formula".
 *
 * The followings are the available columns in table 'formula':
 * @property integer $id
 * @property string $lis
 * @property string $isi_formula
 */
class Formula extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'formula';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('lis, isi_formula', 'required'),
			array('lis', 'length', 'max'=>50),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, lis, isi_formula', 'safe', 'on'=>'search'),
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
			'lis' => 'LIS',
			'isi_formula' => 'Formula',
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
		$criteria->compare('lis',$this->lis,true);
		$criteria->compare('isi_formula',$this->isi_formula,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Formula the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public static function getFieldByLis($lis,$field)
	{
		$sql = "SELECT * FROM formula WHERE lis='$lis'";
		$model = Yii::app()->db->createCommand($sql)->queryRow();
		return $model[$field];
	}

	public static function getNilai($lis,$KodePatient)
	{
		if($lis=='Bilirubin-Indirect'){
			$sql0 = "SELECT pembulatan FROM kode WHERE lis='$lis'";
			$data0 = Yii::app()->db->createCommand($sql0)->queryRow();
				
			//Bilirubin-Indirect = BILIRUBIN-TOTAL/BILIRUBIN DIRECT
			$sql = "SELECT Nilai FROM result WHERE KodePatient='$KodePatient' AND KodeParamater='BILIRUBIN-TOTAL'";
			$data = Yii::app()->db->createCommand($sql)->queryRow();
			$f1 = $data['Nilai'];

			$sql = "SELECT Nilai FROM result WHERE KodePatient='$KodePatient' AND KodeParamater='BILIRUBIN-DIRECT'";
			$data = Yii::app()->db->createCommand($sql)->queryRow();
			$f2 = $data['Nilai'];

			$hasil = $f1-$f2;

			if ($data0['pembulatan'] == 0) {
				$nilai = round($hasil);
			} else if ($data0['pembulatan'] == 99) {
				$nilai = $hasil;
			} else {
				$nilai = round($hasil, $data0['pembulatan']);
			}

			return $nilai;
		} else if($lis=='LDLC'){
			$sql0 = "SELECT pembulatan FROM kode WHERE lis='$lis'";
			$data0 = Yii::app()->db->createCommand($sql0)->queryRow();
				
			//LDLC = CHOLESTEROL-((TRIGLYCERIDES/5)+CHOL HDL DIRECT)
			$sql1 = "SELECT Nilai FROM result WHERE KodePatient='$KodePatient' AND KodeParamater='CHOLESTEROL'";
			$data1 = Yii::app()->db->createCommand($sql1)->queryRow();
			$f1 = $data1['Nilai'];

			$sql2 = "SELECT Nilai FROM result WHERE KodePatient='$KodePatient' AND KodeParamater='CHOL HDL DIRECT'";
			$data2 = Yii::app()->db->createCommand($sql2)->queryRow();
			$f2 = $data2['Nilai'];

			$sql3 = "SELECT Nilai FROM result WHERE KodePatient='$KodePatient' AND KodeParamater='TRIGLYCERIDES'";
			$data3 = Yii::app()->db->createCommand($sql3)->queryRow();
			$f3 = $data3['Nilai'];

			$hasil00 = $f3/5;
			$hasil0 = $hasil00+$f2;
			$hasil = $f1-$hasil0;

			if ($data0['pembulatan'] == 0) {
				$nilai = round($hasil);
			} else if ($data0['pembulatan'] == 99) {
				$nilai = $hasil;
			} else {
				$nilai = round($hasil, $data0['pembulatan']);
			}

			return $nilai;
			//NLR
		} else if($lis=='NLR'){
			$sql0 = "SELECT pembulatan FROM kode WHERE lis='$lis'";
			$data0 = Yii::app()->db->createCommand($sql0)->queryRow();
				
			//LDLC = CHOLESTEROL-((TRIGLYCERIDES/5)+CHOL HDL DIRECT)
			$sql1 = "SELECT Nilai FROM result WHERE KodePatient='$KodePatient' AND KodeParamater='NEUT%'";
			$data1 = Yii::app()->db->createCommand($sql1)->queryRow();
			$f1 = $data1['Nilai'];

			$sql2 = "SELECT Nilai FROM result WHERE KodePatient='$KodePatient' AND KodeParamater='LYMPH%'";
			$data2 = Yii::app()->db->createCommand($sql2)->queryRow();
			$f2 = $data2['Nilai'];

			$hasil00 = $f1/$f2;
			$hasil = $f1/$f2;

			if ($data0['pembulatan'] == 0) {
				$nilai = round($hasil);
			} else if ($data0['pembulatan'] == 99) {
				$nilai = $hasil;
			} else {
				$nilai = round($hasil, $data0['pembulatan']);
			}

			return $nilai;

		} else if($lis=='Globulin'){
			$sql0 = "SELECT pembulatan FROM kode WHERE lis='$lis'";
			$data0 = Yii::app()->db->createCommand($sql0)->queryRow();
				
			//Globulin = PROTEIN TOTAL-ALBUMIN
			$sql = "SELECT Nilai FROM result WHERE KodePatient='$KodePatient' AND KodeParamater='PROTEIN TOTAL'";
			$data = Yii::app()->db->createCommand($sql)->queryRow();
			$f1 = $data['Nilai'];

			$sql = "SELECT Nilai FROM result WHERE KodePatient='$KodePatient' AND KodeParamater='ALBUMIN'";
			$data = Yii::app()->db->createCommand($sql)->queryRow();
			$f2 = $data['Nilai'];

			$hasil = $f1-$f2;

			if ($data0['pembulatan'] == 0) {
				$nilai = round($hasil);
			} else if ($data0['pembulatan'] == 99) {
				$nilai = $hasil;
			} else {
				$nilai = round($hasil, $data0['pembulatan']);
			}

			return $nilai;
		} else {
			return 0;
		}
	}
}
