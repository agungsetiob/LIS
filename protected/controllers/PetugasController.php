<?php
class PetugasController extends Controller
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

	public function actionSinkron()
	{
		$PegawaiID = $_POST['PegawaiID'];

		$sql = "SELECT * FROM pegawai WHERE PegawaiID='$PegawaiID' AND KelMedis='Analis'";
		$data = Yii::app()->db2->createCommand($sql)->queryRow();
		$jumlah = count($data);

		if($jumlah!=1){
			$sql2 = "SELECT COUNT(*) AS jumlah FROM petugas WHERE id_petugas='$PegawaiID'";
			$data2 = Yii::app()->db->createCommand($sql2)->queryRow();

			if($data2['jumlah']==0){
				$proses = "INSERT INTO petugas(id_petugas,nama) VALUES('$data[PegawaiID]','$data[Pegawai]')";
				Yii::app()->db->createCommand($proses)->execute();
			} else {
				$proses = "UPDATE petugas SET nama='$data[Pegawai]' WHERE id_petugas='$PegawaiID'";
				Yii::app()->db->createCommand($proses)->execute();
			}

			echo "sukses";
		} else {
			echo "tidak";
		}
	}

	/**
	* Creates a new model.
	* If creation is successful, the browser will be redirected to the 'view' page.
	*/
	public function actionCreate()
	{
		$model=new Petugas;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Petugas']))
		{
			$model->attributes=$_POST['Petugas'];
			if($model->save())
				$this->redirect(array('index'));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	* Updates a particular model.
	* If update is successful, the browser will be redirected to the 'view' page.
	* @param integer $id the ID of the model to be updated
	*/
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Petugas']))
		{
			$model->attributes=$_POST['Petugas'];
			if($model->save())
				$this->redirect(array('index'));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	* Deletes a particular model.
	* If deletion is successful, the browser will be redirected to the 'admin' page.
	* @param integer $id the ID of the model to be deleted
	*/
	public function actionDelete($id)
	{
		if(Yii::app()->request->isPostRequest)
		{
			// we only allow deletion via POST request
			$this->loadModel($id)->delete();

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax']))
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}


	/**
	* Manages all models.
	*/
	public function actionIndex()
	{
		$model=new Petugas('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Petugas']))
		$model->attributes=$_GET['Petugas'];

		$this->render('index',array(
			'model'=>$model,
		));
	}

	/**
	* Returns the data model based on the primary key given in the GET variable.
	* If the data model is not found, an HTTP exception will be raised.
	* @param integer the ID of the model to be loaded
	*/
	public function loadModel($id)
	{
		$model=Petugas::model()->findByPk($id);
		if($model===null)
		throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	* Performs the AJAX validation.
	* @param CModel the model to be validated
	*/
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='petugas-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}

	public function actionAktif($id)
	{
		$model = $this->loadModel($id);
		if($model->is_aktif == 0) {
			$model->is_aktif = 1;
		} else {
			$model->is_aktif = 0;
		}
		$model->save();

		$this->redirect(array('index'));
	}
}