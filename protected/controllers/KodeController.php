<?php
class KodeController extends Controller
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

	public function actionChild($id)
	{
		$model=Kode::model()->findAll(array('condition'=>'parent_id=:id','params'=>array(':id'=>$id)));

		$this->renderPartial('child',array(
			'model'=>$model,
			'id'=>$id,
		));
	}

	public function actionCdelete()
	{
		$model = $this->loadModel($_POST['id']);
		$model->parent_id=0;
		$model->save(false);
	}

	public function actionCadd()
	{
		$model = $this->loadModel($_POST['id']);
		$model->parent_id=$_POST['idParent'];
		$model->save(false);
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

		$this->render('view',array(
			'model'=>$this->loadModel($id),
			'kode'=>$kode
		));
	}

	/**
	* Creates a new model.
	* If creation is successful, the browser will be redirected to the 'view' page.
	*/
	public function actionCreate()
	{
		$model=new Kode;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Kode']))
		{
			$model->attributes=$_POST['Kode'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	public function actionCreate2()
	{
		$model=new Kode;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Kode']))
		{
			$model->attributes=$_POST['Kode'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('create2',array(
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

		if(isset($_POST['Kode']))
		{
			$model->attributes=$_POST['Kode'];
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
		$model=new Kode('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Kode']))
		$model->attributes=$_GET['Kode'];

		$this->render('index',array(
			'model'=>$model,
		));
	}

	/**
	* Manages all models.
	*/
	public function actionIndex2()
	{
		$model=new Kode('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Kode']))
		$model->attributes=$_GET['Kode'];

		$this->render('index2',array(
			'model'=>$model,
		));
	}

	public function actionEditable()
	{
		if(Yii::app()->request->isAjaxRequest)
		{
			Yii::import('booster.components.TbEditableSaver');
			$es=new TbEditableSaver('Kode');
			$es->update();
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}

	/**
	* Returns the data model based on the primary key given in the GET variable.
	* If the data model is not found, an HTTP exception will be raised.
	* @param integer the ID of the model to be loaded
	*/
	public function loadModel($id)
	{
		$model=Kode::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='kode-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}

	public function actionRekap()
	{
		$sql = "SELECT b.id, b.nama, b.lis, b.parameter, a.sex, a.umur1, a.umur2, a.waktu, a.nr1, a.nr2, a.nr FROM kode_detail a RIGHT JOIN kode b ON a.id_kode=b.id ORDER BY b.lis";
		$model = Yii::app()->db->createCommand($sql)->queryAll();

		$sql2 = "SELECT b.id, b.nama, b.lis, b.parameter, a.sex, a.umur1, a.umur2, a.waktu, a.nk1, a.nk2 FROM kode_kritis a RIGHT JOIN kode b ON a.id_kode=b.id ORDER BY b.lis";
		$model2 = Yii::app()->db->createCommand($sql2)->queryAll();

		$this->renderPartial('rekap',array(
			'model'=>$model,
			'model2'=>$model2,
		));
	}
}