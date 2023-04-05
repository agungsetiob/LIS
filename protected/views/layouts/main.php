<!DOCTYPE html>
<html>

<head>
  <title>LIS YAMHATEVY - <?= Pengaturan::item('nama_rs') ?></title>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
  <meta name="description" content="Laboratorium Information System">
  <link rel="shortcut icon" type="image/png" href="images/logo.png" />
  <link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/bower_components/font-awesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/bower_components/select2/dist/css/select2.min.css">
  <link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
  <link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/dist/css/AdminLTE.min.css">
  <link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/dist/css/skins/_all-skins.min.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  <style>
    .btn-group {
      margin: 0px 0px;
    }
  </style>
</head>

<body class="hold-transition skin-green sidebar-mini">
  <div class="wrapper">

    <header class="main-header">
      <a href="<?php echo Yii::app()->baseUrl; ?>" class="logo">
        <span class="logo-mini"><b>L</b>IS</span>
        <span class="logo-lg"><b>LIS</b> YAMHATEVY</span>
      </a>
      <nav class="navbar navbar-static-top">
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </a>

        <div class="navbar-custom-menu">
          <ul class="nav navbar-nav">
            <li class="dropdown user user-menu">
              <a href="<?= Yii::app()->createUrl("site/logout") ?>" class="dropdown-toggle">
                <i class="fa fa-sign-out"></i>
                <span class="hidden-xs">Logout</span>
              </a>
            </li>
          </ul>
        </div>
      </nav>
    </header>

    <aside class="main-sidebar">
      <?php $this->renderPartial("/layouts/sidebar"); ?>
    </aside>

    <div class="content-wrapper">
      <?php echo $content; ?>
    </div>

    <footer class="main-footer">
      <div class="pull-right hidden-xs">
        <b>Version</b> <?= Pengaturan::item('version') ?>
      </div>
      <strong>Copyright &copy; <?= date("Y") ?></strong>
    </footer>
  </div>

  <script src="<?php echo Yii::app()->theme->baseUrl; ?>/dist/js/adminlte.min.js"></script>
  <script src="<?php echo Yii::app()->theme->baseUrl; ?>/dist/js/loadingoverlay.js"></script>
  <script src="<?php echo Yii::app()->theme->baseUrl; ?>/bower_components/select2/dist/js/select2.full.min.js"></script>
  <script src="<?php echo Yii::app()->theme->baseUrl; ?>/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
  <script src="<?php echo Yii::app()->theme->baseUrl; ?>/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
  <script>
    $(document).ajaxStart(function() {
      $.LoadingOverlay("show", {
        zIndex: 100000
      });
    });

    $(document).ajaxStop(function() {
      $.LoadingOverlay("hide");
    });

    $(document).ready(function() {
      $('.sidebar-menu').tree()
      $('.select2').select2();
    })
  </script>
</body>

</html>