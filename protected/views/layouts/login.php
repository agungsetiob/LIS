<!DOCTYPE html>
<html>

<head>
  <title>LIS YAMHATEVY - <?= Pengaturan::item('nama_rs') ?></title>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
  <meta name="description" content="Laboratorium Information System">
  <link rel="shortcut icon" type="image/png" href="images/logo.png" />
  <link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/dist/css/AdminLTE.min.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  <style>
    body {
      height: 0%;
    }
  </style>
</head>

<body class="hold-transition login-page">
  <div class="login-box">
    <div class="login-box-body">
      <center><img height="100px" src="images/logo.png"></center>
      <h4 class="text-center"><b>Laboratorium Information System</b></h4>
      <hr>
      <?php echo $content; ?>
    </div>
  </div>
</body>

</html>