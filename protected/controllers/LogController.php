<?php
class LogController extends Controller
{
	public $layout = '//layouts/main';

	public function filters()
	{
		return array(
			'rights',
		);
	}

	public function actionIndex()
	{
		$model = new Log('search');
		$model->unsetAttributes();
		if (isset($_GET['Log']))
			$model->attributes = $_GET['Log'];

		$this->render('index', array(
			'model' => $model,
		));
	}
}
