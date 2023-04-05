<?php
class KodeKritisController extends Controller
{
	/**
	* @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	* using two-column layout. See 'protected/views/layouts/column2.php'.
	*/
	public $layout='//layouts/column1';

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
	* Creates a new model.
	* If creation is successful, the browser will be redirected to the 'view' page.
	*/
	public function actionCreate()
	{
		$model=new KodeKritis;
		$model->id_kode=$_POST['id_kode'];
		$model->sex=$_POST['sex'];
		$model->umur1=$_POST['umur1'];
		$model->umur2=$_POST['umur2'];
		$model->waktu=$_POST['waktu'];
		$model->nk1=$_POST['nk1'];
		$model->nk2=$_POST['nk2'];
		$model->save(false);
	}

	public function actionAdmin($id)
	{
		$model=KodeKritis::model()->findAll(array('condition'=>'id_kode=:id','params'=>array(':id'=>$id)));

		$this->renderPartial('admin',array(
			'model'=>$model,
			'id'=>$id,
		));
	}

	public function actionUbah()
	{
		$id = $_POST['id'];
		$field = $_POST['field'];
		$value = $_POST['value'];

		$sql = "UPDATE kode_kritis SET $field='$value' WHERE id=$id";
		Yii::app()->db->createCommand($sql)->execute();
	}

	/**
	* Deletes a particular model.
	* If deletion is successful, the browser will be redirected to the 'admin' page.
	* @param integer $id the ID of the model to be deleted
	*/
	public function actionDelete()
	{
		$this->loadModel($_POST['id'])->delete();
	}

	/**
	* Returns the data model based on the primary key given in the GET variable.
	* If the data model is not found, an HTTP exception will be raised.
	* @param integer the ID of the model to be loaded
	*/
	public function loadModel($id)
	{
		$model=KodeKritis::model()->findByPk($id);
		if($model===null)
		throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}
}