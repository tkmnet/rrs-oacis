<?php
use adf\Config;
?>
<!DOCTYPE html>
<html>
<head>
<?php $title="Index"; ?>
<?php include 'component/head.php';?>

</head>
<body class="hold-transition skin-blue sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">

  <?php include 'component/main-header.php';?>

  <!-- =============================================== -->

  <!-- Left side column. contains the sidebar -->
  <?php include 'component/main-sidebar.php';?>
  
  <!-- =============================================== -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
          Dashboard
        <small></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?= Config::$TOP_PATH ?>"><i class="fa fa-dashboard"></i>RRS-OACIS</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
    
          <!-- simulator submission form  -->
          <?php //include 'component/box-add_parameter.php';?>

        <!--
          <div class="row">
          <div class="col-md-6">
        -->
          <!-- agent submission form  -->
        <!--
          <?php //include 'component/box-add_agent.php';?>
          </div>
          <div class="col-md-6">
        -->
          <!-- map submission form  -->
          <?php //include 'component/box-add_map.php';?>
        <!--
          </div>
          </div>
        -->

          <?php include 'component/box-agentlist.php';?>
          <?php include 'component/box-maplist.php';?>

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- =============================================== -->

  <?php include 'component/main-footer.php';?>
  
  <!-- =============================================== -->

</div>
<!-- ./wrapper -->

<?php include 'component/footerscript.php';?>
<!-- SlimScroll -->
<script src="./plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="./plugins/fastclick/fastclick.js"></script>


<script>
</script>
</body>
