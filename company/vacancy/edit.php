<?php
if (!isset($_SESSION['ADMIN_COMPANYID'])) {
  redirect(web_root . "company/index.php");
}


$jobid = $_GET['id'];
$job = new Jobs();
$res = $job->single_job($jobid);

?>
<form class="form-horizontal span6" action="controller.php?action=edit" method="POST">

  <div class="row">
    <div class="col-lg-12">
      <h1 class="page-header">Actualizar Vacante Laboral</h1>
    </div>
    <!-- /.col-lg-12 -->
  </div>

  <div class="form-group">
    <div class="col-md-8">
      <label class="col-md-4 control-label" for="COMPANYNAME">Nombre de la Compañía:</label>

      <div class="col-md-8">
        <input type="hidden" name="JOBID" value="<?php echo $res->JOBID; ?>">
        <select class="form-control input-sm" id="COMPANYID" name="COMPANYID">
          <!-- <option value="None">Seleccionar</option> -->
          <?php
          // $sql ="Select * From tblcompany WHERE COMPANYID=".$res->COMPANYID;
          $sql = "Select * From tblcompany WHERE COMPANYID='" . $_SESSION['ADMIN_COMPANYID'] . "'";
          $mydb->setQuery($sql);
          $result  = $mydb->loadResultList();
          foreach ($result as $row) {
            # code...
            echo '<option SELECTED value=' . $row->COMPANYID . '>' . $row->COMPANYNAME . '</option>';
          }
          // $sql ="Select * From tblcompany WHERE COMPANYID!=".$res->COMPANYID;
          // $mydb->setQuery($sql);
          // $result  = $mydb->loadResultList();
          // foreach ($result as $row) {
          //   # code...
          //   echo '<option value='.$row->COMPANYID.'>'.$row->COMPANYNAME.'</option>';
          // }

          ?>
        </select>
      </div>
    </div>
  </div>
  <div class="form-group">
    <div class="col-md-8">
      <label class="col-md-4 control-label" for="CATEGORY">Categoría:</label>

      <div class="col-md-8">
        <select class="form-control input-sm" id="CATEGORY" name="CATEGORY">
          <option value="None">Seleccionar</option>
          <?php
          $sql = "SELECT * FROM `tblcategory` WHERE CATEGORY='" . $res->CATEGORY . "'";
          $mydb->setQuery($sql);
          $cur  = $mydb->loadResultList();
          foreach ($cur as $result) {
            # code...
            echo '<option SELECTED value=' . $result->CATEGORYID . '>' . $result->CATEGORY . '</option>';
          }
          $sql = "SELECT * FROM `tblcategory` WHERE CATEGORY!='" . $res->CATEGORY . "'";
          $mydb->setQuery($sql);
          $cur  = $mydb->loadResultList();
          foreach ($cur as $result) {
            # code...
            echo '<option value=' . $result->CATEGORYID . '>' . $result->CATEGORY . '</option>';
          }

          ?>
        </select>
      </div>
    </div>
  </div>
  <div class="form-group">
    <div class="col-md-8">
      <label class="col-md-4 control-label" for="OCCUPATIONTITLE">Título Trabajo:</label>
      <div class="col-md-8">
        <input class="form-control input-sm" id="OCCUPATIONTITLE" name="OCCUPATIONTITLE" placeholder="Título Trabajo" autocomplete="none" value="<?php echo $res->OCCUPATIONTITLE; ?>" />
      </div>
    </div>
  </div>

  <div class="form-group">
    <div class="col-md-8">
      <label class="col-md-4 control-label" for="REQ_NO_EMPLOYEES">Vacantes:</label>
      <div class="col-md-8">
        <input class="form-control input-sm" id="REQ_NO_EMPLOYEES" name="REQ_NO_EMPLOYEES" placeholder="Vacantes" autocomplete="none" value="<?php echo $res->REQ_NO_EMPLOYEES ?>" />
      </div>
    </div>
  </div>

  <div class="form-group">
    <div class="col-md-8">
      <label class="col-md-4 control-label" for="SALARIES">Salario:</label>
      <div class="col-md-8">
        <input class="form-control input-sm" id="SALARIES" name="SALARIES" placeholder="Salario" autocomplete="none" value="<?php echo $res->SALARIES ?>" />
      </div>
    </div>
  </div>

  <div class="form-group">
    <div class="col-md-8">
      <label class="col-md-4 control-label" for="DURATION_EMPLOYEMENT">Duración del Empleo:</label>
      <div class="col-md-8">
        <input class="form-control input-sm" id="DURATION_EMPLOYEMENT" name="DURATION_EMPLOYEMENT" placeholder="Duración del Empleo" autocomplete="none" value="<?php echo $res->DURATION_EMPLOYEMENT ?>" />
      </div>
    </div>
  </div>

  <div class="form-group">
    <div class="col-md-8">
      <label class="col-md-4 control-label" for="QUALIFICATION_WORKEXPERIENCE">Calificación/Experiencia Laboral:</label>
      <div class="col-md-8">
        <textarea class="form-control input-sm" id="QUALIFICATION_WORKEXPERIENCE" name="QUALIFICATION_WORKEXPERIENCE" placeholder="Calificación/Experiencia Laboral" autocomplete="none"><?php echo $res->QUALIFICATION_WORKEXPERIENCE ?></textarea>
      </div>
    </div>
  </div>

  <div class="form-group">
    <div class="col-md-8">
      <label class="col-md-4 control-label" for="JOBDESCRIPTION">Descripción del Trabajo:</label>
      <div class="col-md-8">
        <textarea class="form-control input-sm" id="JOBDESCRIPTION" name="JOBDESCRIPTION" placeholder="Descripción del Trabajo" autocomplete="none"><?php echo $res->JOBDESCRIPTION ?></textarea>
      </div>
    </div>
  </div>

  <div class="form-group">
    <div class="col-md-8">
      <label class="col-md-4 control-label" for="PREFEREDSEX">Género Preferido:</label>
      <div class="col-md-8">
        <select class="form-control input-sm" id="PREFEREDSEX" name="PREFEREDSEX">
          <option value="None">Seleccionar</option>
          <option value="Masculino" <?php echo ($res->PREFEREDSEX == 'Masculino') ? 'selected="true"' : ''; ?>>Masculino</option>
          <option value="Femenino" <?php echo ($res->PREFEREDSEX == 'Femenino') ? 'selected="true"' : ''; ?>>Femenino</option>
          <option value="Masculino/Femenino" <?php echo ($res->PREFEREDSEX == 'Masculino/Femenino') ? 'selected="true"' : ''; ?>>Masculino/Femenino</option>
        </select>
      </div>
    </div>
  </div>



  <div class="form-group">
    <div class="col-md-8">
      <label class="col-md-4 control-label" for="idno"></label>

      <div class="col-md-8">
        <button class="btn btn-primary btn-sm" name="save" type="submit"><span class="fa fa-save fw-fa"></span> Guardar</button>
        <!-- <a href="index.php" class="btn btn-info"><span class="glyphicon glyphicon-arrow-left"></span>&nbsp;<strong>Back</strong></a> -->

      </div>
    </div>
  </div>



</form>