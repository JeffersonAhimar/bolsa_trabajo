<?php
$view = isset($_GET['view']) ? $_GET['view'] : "";
$appl = new Applicants_mo();
$applicant = $appl->single_applicant($_SESSION['APPLICANTID']);
$appl_photo = $appl->getProfilePictureMoodle($_SESSION['APPLICANTID']);
?>
<style type="text/css">
  .panel-body img {
    width: 100%;
    height: 50%;
  }

  .panel-body img:hover {
    cursor: pointer;
  }
</style>
<section id="inner-headline">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <h2 class="pageTitle">Perfil</h2>
      </div>
    </div>
  </div>
</section>
<div class="container" style="margin-top: 10px;min-height: 600px;">

  <div class="row">

    <div class="col-sm-3">
      <!--left col-->
      <div class="panel panel-default">

        <div class="panel-body">
          <div id="image-container" style="text-align: center;">
            <img title="profile image" src="
            <?php
            echo 'https://www.educacioncajamarca.com/pluginfile.php/' . $appl_photo->id . '/user/icon/academi/f1?rev=' . $appl_photo->picture;
            ?>
            " style="height: 100px; width: 100px;">

          </div>

        </div>


        <ul class="list-group">
          <li class="list-group-item text-muted" style="text-align: center">
            <!-- <a href="index.php?view=edit_profile&id=<?php echo $applicant->id; ?>">Editar Perfil</a> -->
            <a href="
            <?php echo 'https://www.educacioncajamarca.com/user/edit.php?id=' . $applicant->id . '&returnto=profile'; ?>
            " target="_blank">Editar Perfil</a>
          </li>
          <li class="list-group-item text-right"><span class="pull-left"><strong>Nombres</strong></span>
            <?php if ($applicant->firstname != '') {
              echo $applicant->firstname;
            } else {
              echo '---';
            } ?>
          </li>
          <li class="list-group-item text-right"><span class="pull-left"><strong>Apellidos</strong></span>
            <?php if ($applicant->lastname != '') {
              echo $applicant->lastname;
            } else {
              echo '---';
            } ?>
          </li>
          <li class="list-group-item text-right"><span class="pull-left"><strong>Email</strong></span>
            <?php if ($applicant->email != '') {
              echo $applicant->email;
            } else {
              echo '---';
            } ?>
          </li>
          <li class="list-group-item text-right"><span class="pull-left"><strong>Institución</strong></span>
            <?php if ($applicant->institution != '') {
              echo $applicant->institution;
            } else {
              echo '---';
            } ?>
          </li>
          <li class="list-group-item text-right"><span class="pull-left"><strong>Teléfono</strong></span>
            <?php if ($applicant->phone1 != '') {
              echo $applicant->phone1;
            } else {
              echo '---';
            } ?>
          </li>
          <li class="list-group-item text-right"><span class="pull-left"><strong>Teléfono 2</strong></span>
            <?php if ($applicant->phone2 != '') {
              echo $applicant->phone2;
            } else {
              echo '---';
            } ?>
          </li>
        </ul>

        <div class="box box-solid">
          <div class="box-body no-padding">
            <ul class="nav nav-pills nav-stacked">
              <li class="<?php echo ($view == 'appliedjobs' || $view == '') ? 'active' : ''; ?>"><a href="<?php echo web_root . 'applicant/index.php?view=appliedjobs'; ?>"><i class="fa fa-list"></i> Trabajos Aplicados
                </a></li>
              <li class="<?php echo ($view == 'message') ? 'active' : ''; ?>"><a href="<?php echo web_root . 'applicant/index.php?view=message'; ?>"><i class="fa fa-envelope-o"></i> Mensajes
                  <span class="label label-success pull-right"><?php echo isset($showMsg->COUNT) ? $showMsg->COUNT : 0; ?></span></a></li>

            </ul>
          </div>
          <!-- /.box-body -->
        </div>

        <!-- /.box -->
      </div>

    </div>
    <div class="col-sm-9">
      <?php
      check_message();
      check_active();

      ?>

      <!-- <h1><?php echo $applicant->FNAME . ' ' . $applicant->LNAME; ?>  </h1> -->
      <?php

      switch ($view) {
        case 'message':
          # code...
          require_once("message.php");
          break;
        case 'notification':
          # code...
          require_once("notification.php");
          break;
        case 'appliedjobs':
          # code...
          require_once("appliedjobs.php");
          break;
        case 'accounts':
          # code...
          // require_once("accounts.php");
          break;

        default:
          # code...
          require_once("appliedjobs.php");
          break;
      }
      ?>
    </div>
    <!--/col-sm-9-->
  </div>
  <!--/row-->

</div>
<!--/contanier-->

<?php
unset($_SESSION['appliedjobs']);
unset($_SESSION['accounts']);
?>