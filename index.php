<?php
error_reporting(0);
date_default_timezone_set('Asia/Makassar');

$yii = dirname(__FILE__) . '/lib/yii.php';
$config = dirname(__FILE__) . '/protected/config/main.php';

require_once($yii);
Yii::createWebApplication($config)->run();
