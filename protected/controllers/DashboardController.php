<?php

class DashboardController extends Controller
{
	public $layout='//layouts/main';

	/**
	* @return array action filters
	*/

	public function filters()
	{
		return array(
			'rights',
		);
	}

	public function actionIndex()
	{
		$sql = "SELECT DATE(tanggal) AS tanggal FROM periksa WHERE state != 3 AND MONTH(tanggal) = MONTH(CURRENT_DATE()) AND YEAR(tanggal) = YEAR(CURRENT_DATE()) GROUP BY DATE(tanggal)";
		$model = Yii::app()->db->createCommand($sql)->queryAll();

		$this->render('index', array('model' => $model));
	}

	public function actionUbah()
	{
		$model=new RubahPassword;
		$model->username = Yii::app()->user->name;
		$model->id = Yii::app()->user->id;

		if(isset($_POST['ajax']) && $_POST['ajax']==='rubah-password-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		if(isset($_POST['RubahPassword']))
		{
			$model->attributes=$_POST['RubahPassword'];
			if($model->validate()){
				$user=User::model()->findByPk($model->id);
				$user->password=md5($model->password);
				if($user->save()){
					Yii::app()->user->setFlash('info','Proses berhasil');
					$this->refresh();
				}
			}
		}

		$this->render('ubah',array(
			'model'=>$model,
		));
	}
}
