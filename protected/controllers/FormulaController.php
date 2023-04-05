<?php
class FormulaController extends Controller
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
		$model=new Formula('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Formula']))
		$model->attributes=$_GET['Formula'];

		$this->render('index',array(
			'model'=>$model,
		));
	}
}