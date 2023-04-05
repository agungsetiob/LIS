<?php
class PaketController extends Controller
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

	private function removeElement($array,$value) {
		return array_diff($array, (is_array($value) ? $value : array($value)));
	}

	public function actionKode()
	{
		$model = Kode::model()->findByPk($_POST['id']);
		if($model->id_paket!=$_POST['idParent'])
		{
			$model->id_paket=$model->id_paket.','.$_POST['idParent'];
		}
		$model->save(false);
	}

	public function actionKdelete()
	{
		$model = Kode::model()->findByPk($_POST['id']);
		$paket = explode(",",$model->id_paket);
		$result = $this->removeElement($paket,$_POST['idPaket']);
		$idPaket = implode(",",$result);
		$model->id_paket = $idPaket;
		$model->save(false);
	}

	public function actionChild($id)
	{
		$criteria=new CDbCriteria;

		$criteria->compare('id_paket',$id,true);

		$model=Kode::model()->findAll($criteria);

		$this->renderPartial('child',array(
			'model'=>$model,
			'id'=>$id,
		));
	}

	/**
	* Displays a particular model.
	* @param integer $id the ID of the model to be displayed
	*/
	public function actionView($id)
	{
		$kode=new Kode('search');
		$kode->unsetAttributes();  // clear any default values
		if(isset($_GET['Kode']))
		$kode->attributes=$_GET['Kode'];

		$modelKode = Kode::model()->findAll(array('order'=>'grup1'));

		$this->render('view',array(
			'model'=>$this->loadModel($id),
			'kode'=>$kode,
			'modelKode'=>$modelKode
		));
	}

	/**
	* Creates a new model.
	* If creation is successful, the browser will be redirected to the 'view' page.
	*/
	public function actionCreate()
	{
		$model=new Paket;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Paket']))
		{
			$model->attributes=$_POST['Paket'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
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

		if(isset($_POST['Paket']))
		{
			$model->attributes=$_POST['Paket'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
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
		$model=new Paket('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Paket']))
		$model->attributes=$_GET['Paket'];

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
		$model=Paket::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='paket-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}

	public function actionKodeBatch($id)
	{
		$model = explode(",", $_POST['kode']);
		foreach($model as $data){
			$kode = Kode::model()->findByPk($data);
			if($kode->id_paket!=$id)
			{
				$kode->id_paket=$kode->id_paket.','.$id;
			}
			$kode->save(false);
		}
		echo "sukses";
	}

	public function actionDetail($id)
	{
		$model = PaketDetail::model()->findAll(array('condition'=>'id_paket=:id','params'=>array(':id'=>$id)));

		$this->renderPartial('detail',array(
			'model'=>$model,
			'id'=>$id,
		));
	}

	public function actionDdelete()
	{
		PaketDetail::model()->findByPk($_POST['id'])->delete();
	}

	public function actionKodeBatchDetail($id)
	{
		$model = explode(",", $_POST['kode']);
		foreach($model as $data){
			$paketDetail = new PaketDetail;
			$paketDetail->id_paket = $id;
			$paketDetail->id_kode = $data;
			$paketDetail->save();
		}
		echo "sukses";
	}
}