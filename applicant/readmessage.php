<?php
$id = isset($_GET['id']) ? $_GET['id'] : 0;

$sql = "UPDATE `tbljobregistration` SET HVIEW=1 WHERE `REGISTRATIONID`='{$id}'";
$mydb->setQuery($sql);
$mydb->executeQuery();


$sql = "SELECT * FROM `tblcompany` c,`tbljobregistration` jr,  `tbljob` j  WHERE c.`COMPANYID`=jr.`COMPANYID` AND jr.`JOBID`=j.`JOBID` AND `REGISTRATIONID`='{$id}'";
$mydb->setQuery($sql);
$res = $mydb->loadSingleResult();

$applicant = new Applicants_mo();
$appl  = $applicant->single_applicant($_SESSION['APPLICANTID']);


?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Main content -->
  <section class="content">
    <div class="row">
      <!-- /.col -->
      <div class="col-md-12">
        <div class="box box-primary">
          <div class="box-header with-border">
            <h3 class="box-title">Leer Mensaje</h3>
          </div>
          <!-- /.box-header -->
          <div class="box-body no-padding">
            <div class="mailbox-read-info">
              <h3><?php echo $res->OCCUPATIONTITLE; ?></h3>
              <h5>De: <?php echo $res->COMPANYNAME; ?>
                <span class="mailbox-read-time pull-right"><?php echo date_format(date_create($res->DATETIMEAPPROVED), 'd M. Y h:i a'); ?></span>
              </h5>
            </div>
            <!-- /.mailbox-read-info -->
            <div class="mailbox-controls with-border text-center">
              <div class="btn-group">

              </div>

            </div>
            <!-- /.mailbox-controls -->
            <div class="mailbox-read-message">
              <p>Hola <?php echo $appl->firstname; ?>,</p>
              <p><?php echo $res->REMARKS; ?></p>

              <p>Gracias,<br>Att. <?php echo $res->COMPANYNAME; ?></p>
            </div>
            <!-- /.mailbox-read-message -->
          </div>

          <div class="box-footer">
          </div>
          <!-- /.box-footer -->
        </div>
        <!-- /. box -->
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
  </section>
  <!-- /.content -->
</div>