<?php

class ParameterController extends Controller
{
	public $layout='//layouts/main';

	public function filters()
	{
		return array(
			'rights',
		);
	}
	
	public function actionIndex()
	{
		$model=new Parameter('search');
		$model->unsetAttributes();
		if(isset($_GET['Parameter']))
		$model->attributes=$_GET['Parameter'];

		$this->render('index',array(
			'model'=>$model,
		));
	}

	public function actionView($id)
	{
		$model= Parameter::model()->find(array('condition'=>'jenis=:id','params'=>array(':id'=>$id)));

		$this->render('view',array(
			'model'=>$model,
		));
	}

	public function actionDetail($id)
	{
		$model= Parameter::model()->findAll(array('condition'=>'jenis=:id','params'=>array(':id'=>$id)));

		$this->renderPartial('detail',array(
			'model'=>$model,
			'id'=>$id,
		));
	}

	public function actionAdd()
	{
		$model=new Parameter;
		$model->jenis=$_POST['jenis'];
		$model->id=$_POST['id'];
		$model->nama=$_POST['nama'];
		$model->order=$_POST['order'];
		$model->save();
	}

	public function actionDelete()
	{
		$sql = "DELETE FROM parameter WHERE jenis='$_POST[jenis]' AND id='$_POST[id]'";
		Yii::app()->db->createCommand($sql)->execute();
	}

	public function actionEdit()
	{
		$sql = "UPDATE parameter SET nama='$_POST[nama]' WHERE jenis='$_POST[jenis]' AND id='$_POST[id]'";
		Yii::app()->db->createCommand($sql)->execute();
	}

	public function actionEdit2()
	{
		$sql = "UPDATE parameter SET `order`='$_POST[order]' WHERE jenis='$_POST[jenis]' AND id='$_POST[id]'";
		Yii::app()->db->createCommand($sql)->execute();
	}
}