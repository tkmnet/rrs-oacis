<?php
use adf\Config;
?>
<!DOCTYPE html>
<html>
<head>
<?php $title="Apps"; ?>
<?php include Config::$SRC_REAL_URL.'view/component/head.php';?>

</head>
<body class="hold-transition skin-blue sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">

  <?php include Config::$SRC_REAL_URL.'view/component/main-header.php';?>

  <!-- =============================================== -->

  <!-- Left side column. contains the sidebar -->
  <?php include Config::$SRC_REAL_URL.'view/component/main-sidebar.php';?>
  
  <!-- =============================================== -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        TC2017 Coordinator
        <small>RRS 2017 TechnicalChallenge Coordinator</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?=Config::$TOP_PATH ?>"><i class="fa fa-dashboard"></i><?= adf\Config::APP_NAME ?></a></li>
        <li class="active">Manual Post</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <?php include 'box-add_session.php';?>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- =============================================== -->

  <?php include Config::$SRC_REAL_URL.'view/component/main-footer.php';?>
  
  <!-- =============================================== -->

</div>
<!-- ./wrapper -->

<?php include Config::$SRC_REAL_URL.'view/component/footerscript.php';?>

</body>
