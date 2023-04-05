<?php
class ResultController extends Controller
{
	/**
	* @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	* using two-column layout. See 'protected/views/layouts/column2.php'.
	*/
	public $layout='//layouts/main';

	/**
	* @return array action filters
	*/
	public function filters()
	{
		return array(
			'rights', // perform access control for CRUD operations
		);
	}

	/**
	* Manages all models.
	*/
	public function actionIndex()
	{
		$model=new Result('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Result']))
		$model->attributes=$_GET['Result'];

		$this->render('index',array(
			'model'=>$model,
		));
	}

	public function actionGrup()
	{
		$model = new VResult('search');
		$model->unsetAttributes();  // clear any default values
		if (isset($_GET['VResult']))
			$model->attributes = $_GET['VResult'];

		$this->render('grup', array(
			'model' => $model,
		));
	}

	public function actionDetail($alat, $sampel, $tgl, $tanggal)
	{
		$sql = "SELECT KodePatient, KodeAlat, KodeParamater, Nilai FROM result WHERE KodePatient = '$sampel'";
        $model = Yii::app()->db->createCommand($sql)->queryAll();

		$this->renderPartial('detail', array(
			'alat' => $alat,
			'sampel' => $sampel,
			'tgl' => $tgl,
			'model' => $model,
		));
	}

	public function actionAcc()
	{
		$id = $_POST['id'];
		$value = $_POST['value'];
		$model = $this->loadModel($id);
		if($value=='true'){
			$model->acc = '1';
		} else {
			$model->acc = '0';
		}
		$model->save();

		$periksa=Periksa::model()->find(array('condition'=>'nomor=:nomor','params'=>array(':nomor'=>$model->KodePatient)));
		$periksa->update_by=Yii::app()->user->nama;
		$periksa->update_at=date("Y:m:d H:i:s");
		$periksa->save(false);
	}

	public function actionGacc()
	{
		$id = $_POST['id'];
		$value = $_POST['value'];
		$nomor = $_POST['nomor'];
		if($value=='true'){
			$acc = '1';
		} else {
			$acc = '0';
		}

		$sql = "SELECT a.KodeParamater FROM result a LEFT JOIN kode b ON a.KodeParamater=b.lis WHERE a.KodePatient LIKE '%$nomor%' AND b.grup1='$id'";
		$detail = Yii::app()->db->createCommand($sql)->queryAll();

		foreach ($detail as $data) {
			$sql0 = "UPDATE result SET acc='$acc' WHERE KodePatient LIKE '%$nomor%' AND KodeParamater='$data[KodeParamater]'";
			Yii::app()->db->createCommand($sql0)->execute();
		}

		$periksa=Periksa::model()->find(array('condition'=>'nomor=:nomor','params'=>array(':nomor'=>$nomor)));
		$periksa->update_by=Yii::app()->user->nama;
		$periksa->update_at=date("Y:m:d H:i:s");
		$periksa->save(false);
	}

	public function actionNilai()
	{
		$id = $_POST['id'];
		$value = $_POST['value'];
		$model = $this->loadModel($id);
		$model->Nilai = $value;
		$model->save();

		$periksa=Periksa::model()->find(array('condition'=>'nomor=:nomor','params'=>array(':nomor'=>$model->KodePatient)));
		$periksa->update_by=Yii::app()->user->nama;
		$periksa->update_at=date("Y:m:d H:i:s");
		$periksa->save();
	}

	public function actionKeterangan()
	{
		$id = $_POST['id'];
		$value = $_POST['value'];
		$model = $this->loadModel($id);
		$model->keterangan = $value;
		$model->save();

		$periksa=Periksa::model()->find(array('condition'=>'nomor=:nomor','params'=>array(':nomor'=>$model->KodePatient)));
		$periksa->update_by=Yii::app()->user->nama;
		$periksa->update_at=date("Y:m:d H:i:s");
		$periksa->save();
	}

	public function actionEditable()
	{
		if(Yii::app()->request->isAjaxRequest)
		{
			Yii::import('booster.components.TbEditableSaver');
			$es=new TbEditableSaver('Result');
			$es->update();
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}

	public function actionCreate()
	{
		$model=new Result;
		$model->KodePatient=$_POST['KodePatient'];
		$model->KodeAlat='-';
		$model->KodeParamater=$_POST['KodeParamater'];
		$model->Nilai=$_POST['Nilai'];
		$model->acc='1';
		$model->save();

		$periksa=Periksa::model()->find(array('condition'=>'nomor=:nomor','params'=>array(':nomor'=>$model->KodePatient)));
		$periksa->update_by=Yii::app()->user->nama;
		$periksa->update_at=date("Y:m:d H:i:s");
		$periksa->save();
	}

	public function actionCek()
	{
		$result = Result::model()->findAll('KodePatient='.$_POST['KodePatient']);
		$jumlah = count($result);
		echo $jumlah;
	}

	public function actionDelete()
	{
		$model = $this->loadModel($_POST['id']);

		$periksa=Periksa::model()->find(array('condition'=>'nomor=:nomor','params'=>array(':nomor'=>$model->KodePatient)));
		$periksa->update_by=Yii::app()->user->nama;
		$periksa->update_at=date("Y:m:d H:i:s");
		$periksa->save();

		$model->delete();
	}

	/**
	* Returns the data model based on the primary key given in the GET variable.
	* If the data model is not found, an HTTP exception will be raised.
	* @param integer the ID of the model to be loaded
	*/
	public function loadModel($id)
	{
		$model=Result::model()->findByPk($id);
		if($model===null)
		throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}
}