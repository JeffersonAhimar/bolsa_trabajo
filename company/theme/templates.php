<!DOCTYPE html>
<html>
<title>Compañía - <?php echo $_SESSION['ADMIN_COMPANYNAME']; ?></title>

<head>
  <meta charset="UTF-8">
  <title>
  </title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.5 -->
  <link rel="stylesheet" href="<?php echo web_root; ?>bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo web_root; ?>plugins/font-awesome/css/font-awesome.min.css">

  <!-- <link rel="stylesheet" href="<?php echo web_root; ?>plugins/dataTables/dataTables.bootstrap.css">  -->
  <!-- <link rel="stylesheet" href="<?php echo web_root; ?>plugins/dataTables/jquery.dataTables.min.css">  -->

  <!-- Ionicons -->
  <!-- <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css"> -->
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo web_root; ?>dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
             folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="<?php echo web_root; ?>dist/css/skins/_all-skins.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="<?php echo web_root; ?>plugins/iCheck/flat/blue.css">
  <!-- Morris chart -->
  <link rel="stylesheet" href="<?php echo web_root; ?>plugins/morris/morris.css">
  <!-- jvectormap -->
  <link rel="stylesheet" href="<?php echo web_root; ?>plugins/jvectormap/jquery-jvectormap-1.2.2.css">
  <!-- Date Picker -->
  <link href="<?php echo web_root; ?>plugins/datepicker/bootstrap-datetimepicker.min.css" rel="stylesheet" media="screen">

  <link rel="stylesheet" href="<?php echo web_root; ?>plugins/datatables/jquery.dataTables.min.css">

  <!-- <link rel="stylesheet" href="<?php echo web_root; ?>plugins/datepicker/datepicker3.css"> -->
  <!-- Daterange picker -->
  <!-- <link rel="stylesheet" href="<?php echo web_root; ?>plugins/daterangepicker/daterangepicker-bs3.css"> -->
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="<?php echo web_root; ?>plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
  <link rel="icon" type="image/x-icon" href="<?php echo web_root; ?>/plugins/home-plugins/img/favicon.png">
</head>

<body class="hold-transition skin-blue fixed sidebar-mini">
  <div class="wrapper">

    <header class="main-header">
      <!-- Logo -->
      <a href="<?php echo web_root; ?>company/vacancy/" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <!-- <span class="logo-mini"><b>CMP</b></span> -->
        <span class="logo-mini"><b><?php echo strtoupper(substr($_SESSION['ADMIN_COMPANYNAME'], 0, 3)); ?></b></span>
        <!-- logo for regular state and mobile devices -->
        <!-- <span class="logo-lg"><b>COMPAÑÍA</b></span> -->
        <span class="logo-lg"><b><?php echo $_SESSION['ADMIN_COMPANYNAME']; ?></b></span>
      </a>
      <!-- Header Navbar: style can be found in header.less -->
      <nav class="navbar navbar-static-top" role="navigation">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
          <span class="sr-only">Toggle navigation</span>
        </a>

        <div class="navbar-custom-menu">
          <ul class="nav navbar-nav">

            <?php
            $user = new Company();
            $singleuser = $user->single_user($_SESSION['ADMIN_COMPANYID']);

            ?>
            <!-- User Account: style can be found in dropdown.less -->
            <li class="dropdown user user-menu" style="padding-right: 15px;">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <img src="<?php
                          if ($singleuser->COMPANYPHOTO == '') {
                            echo web_root . 'uploads/images/no-company.png';
                          } else {
                            echo web_root . 'uploads/images/companies/' . $singleuser->COMPANYPHOTO;
                          }
                          ?>" class="user-image" alt="User Image">

                <span class="hidden-xs"> Sesión: <?php echo $singleuser->COMPANYUSER; ?></span>
              </a>
              <ul class="dropdown-menu">
                <!-- User image -->
                <li class="user-header" style="height: 100%; background-color: #b9d4e3;">
                  <!-- <img data-target="#menuModal" data-toggle="modal" src="../../plugins/home-plugins/img/avatars/admin.png" class="img-circle" alt="User Image" /> -->
                  <img data-target="#menuModal" data-toggle="modal" src="
                  <?php
                  if ($singleuser->COMPANYPHOTO == '') {
                    echo web_root . 'uploads/images/no-company.png';
                  } else {
                    echo web_root . 'uploads/images/companies/' . $singleuser->COMPANYPHOTO;
                  }
                  ?>" class="img-circle" alt="User Image" />
                </li>
                <!-- Menu Footer-->
                <li class="user-footer">
                  <div class="pull-left">
                    <a href="<?php echo web_root . 'company/user/index.php?view=view&id=' . $_SESSION['ADMIN_COMPANYID']; ?>" class="btn btn-default btn-flat">Perfil</a>
                  </div>
                  <div class="pull-right">
                    <a href="<?php echo web_root; ?>company/logout.php" class="btn btn-default btn-flat">Cerrar Sesión</a>
                  </div>
                </li>
              </ul>
            </li>
            <!-- Control Sidebar Toggle Button -->

          </ul>
        </div>
      </nav>
    </header>



    <div class="modal fade" id="menuModal" tabindex="-1">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button class="close" data-dismiss="modal" type="button">x</button>

            <h4 class="modal-title" id="myModalLabel">Imagen Compañía</h4>
          </div>

          <form action="<?php echo web_root; ?>company/user/controller.php?action=photos" enctype="multipart/form-data" method="post">
            <div class="modal-body">
              <div class="form-group">
                <div class="rows">
                  <div class="col-md-12">
                    <div class="rows">
                      <div class="col-md-8">
                        <input class="mealid" type="hidden" name="mealid" id="mealid" value="">
                        <input name="MAX_FILE_SIZE" type="hidden" value="1000000">
                        <input id="photo" name="photo" type="file">
                      </div>

                      <div class="col-md-4"></div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="modal-footer">
              <button class="btn btn-default" data-dismiss="modal" type="button">Cerrar</button> <button class="btn btn-primary" name="savephoto" type="submit">Subir Foto</button>
            </div>
          </form>
        </div><!-- /.modal-content-->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->



    <!-- Left side column. contains the logo and sidebar -->
    <aside class="main-sidebar">
      <!-- sidebar: style can be found in sidebar.less -->
      <section class="sidebar">


        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
          <li class="<?php echo (currentpage() == 'vacancy') ? "active" : false; ?>">
            <a href="<?php echo web_root; ?>company/vacancy/">
              <i class="fa fa-suitcase"></i> <span>Ofertas Laborales</span>
            </a>
          </li>
          <li class="<?php echo (currentpage() == 'applicants') ? "active" : false; ?>">
            <a href="<?php echo web_root; ?>company/applicants/">
              <i class="fa fa-users"></i> <span>Postulantes</span>
              <span class="label label-primary pull-right">
                <?php
                $sql = "SELECT count(*) as 'APPL' FROM `tbljobregistration` WHERE `PENDINGAPPLICATION`=1 AND COMPANYID ='" . $_SESSION['ADMIN_COMPANYID'] . "'";
                $mydb->setQuery($sql);
                $pending = $mydb->loadSingleResult();
                echo $pending->APPL;
                ?>
              </span>
            </a>
          </li>


        </ul>
      </section>
      <!-- /.sidebar -->
    </aside>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">

      <section class="content-header">
        <h1>
          <?php echo isset($title) ? $title : ''; ?>
          <!-- <small>it all starts here</small> -->
        </h1>
        <ol class="breadcrumb">
          <?php

          if ($title != 'Home') {
            # code... 
            $active_title = '';
            if (isset($_GET['view'])) {
              # code...
              $active_title = '<li class=' . $active_title . '><a href="index.php">' . $title . '</a></li>';
            } else {
              $active_title = '<li class=' . $active_title . '>' . $title . '</li>';
            }
            echo '<li><a href=' . web_root . 'company/><i class="fa fa-dashboard"></i> Home</a></li>';
            echo  $active_title;
            echo  isset($_GET['view']) ? '<li class="active">' . $_GET['view'] . '</li>' : '';
          }


          ?>
        </ol>
      </section>
      <section class="content">

        <div class="row">
          <div class="col-xs-12">
            <div class="box">
              <div class="box-body">

                <?php
                check_message();
                require_once $content;
                ?>
              </div>
            </div>
          </div>
        </div>
      </section>
    </div>
    <!-- /.content-wrapper -->


    <footer class="main-footer">
      <div class="pull-right hidden-xs">
        <b>Version</b> 1
      </div>
      <strong>Copyright &copy; 2022 <a href="#">DRE Cajamarca</a>.</strong> Todos los derechos reservados.
    </footer>



</body>
<script type="text/javascript" src="<?php echo web_root; ?>plugins/jQuery/jQuery-2.1.4.min.js"> </script>
<script type="text/javascript" src="<?php echo web_root; ?>bootstrap/js/bootstrap.min.js"></script>
<script src="<?php echo web_root; ?>dist/js/app.min.js"></script>

<script type="text/javascript" src="<?php echo web_root; ?>plugins/datepicker/bootstrap-datepicker.js"></script>
<script type="text/javascript" src="<?php echo web_root; ?>plugins/datepicker/bootstrap-datetimepicker.js" charset="UTF-8"></script>
<script type="text/javascript" src="<?php echo web_root; ?>plugins/datepicker/locales/bootstrap-datetimepicker.uk.js" charset="UTF-8"></script>

<script src="<?php echo web_root; ?>plugins/datatables/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="<?php echo web_root; ?>plugins/datatables/dataTables.bootstrap.min.js"></script>

<script src="<?php echo web_root; ?>plugins/slimScroll/jquery.slimscroll.min.js"></script>

<script type="text/javascript" language="javascript" src="<?php echo web_root; ?>plugins/input-mask/jquery.inputmask.js"></script>
<script type="text/javascript" language="javascript" src="<?php echo web_root; ?>plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
<script type="text/javascript" language="javascript" src="<?php echo web_root; ?>plugins/input-mask/jquery.inputmask.extensions.js"></script>

<script>
  $(function() {
    $("#dash-table").DataTable();
    $('#dash-table2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false
    });
  });

  $('input[data-mask]').each(function() {
    var input = $(this);
    input.setMask(input.data('mask'));
  });


  $('#BIRTHDATE').inputmask({
    mask: "2/1/y",
    placeholder: "mm/dd/yyyy",
    alias: "date",
    hourFormat: "24"
  });
  $('#HIREDDATE').inputmask({
    mask: "2/1/y",
    placeholder: "mm/dd/yyyy",
    alias: "date",
    hourFormat: "24"
  });

  $('.date_picker').datetimepicker({
    format: 'mm/dd/yyyy',
    startDate: '01/01/1950',
    language: 'en',
    weekStart: 1,
    todayBtn: 1,
    autoclose: 1,
    todayHighlight: 1,
    startView: 2,
    minView: 2,
    forceParse: 0

  });
</script>

</html>