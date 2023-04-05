<?php

class DbController extends Controller
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

	public function actionIndex()
	{
		$path = Yii::app()->basePath .'/../_backup/';
		
		$dataArray = array();
		
		$list_files = glob($path .'*.sql');
		if ($list_files)
		{
			$list = array_map('basename',$list_files);
			sort($list);
	
			foreach ( $list as $id=>$filename )
			{
				$columns = array();
				$columns['id'] = $id;
				$columns['nama'] = basename ( $filename);
				$columns['ukuran'] = floor(filesize ( $path. $filename)/ 1024) .' KB';
				$columns['waktu'] = date( DATE_RFC822, filectime($path .$filename) );
				$dataArray[] = $columns;
			}
		}
		
		$dataProvider = new CArrayDataProvider($dataArray);
		$this->render('index', array(
			'dataProvider' => $dataProvider,
		));
	}

	public function actionBackup()
	{
		define("BACKUP_PATH", Yii::app()->basePath .'/../_backup/');
	
		$name_string   = "sentosa";
		$date_string   = date("d.m.Y");
		$time_string   = date("H.i.s");

		$cmd = "mysqldump -uroot -p4dm1nl1s lisypm > " . BACKUP_PATH . "{$name_string}.sql";

		exec("backup.bat");
		
		$this->redirect(array('index'));
	}
}