<?php
if (!isset($_SESSION['ADMIN_USERID'])) {
  redirect(web_root . "company/index.php");
}


$companyid = $_GET['id'];
$company = new Company();
$res = $company->single_company($companyid);

?>
<form class="form-horizontal span6" action="controller.php?action=edit" method="POST">


  <div class="row">
    <div class="col-lg-12">
      <h1 class="page-header">Actualizar Compañía</h1>
    </div>
    <!-- /.col-lg-12 -->
  </div>
  <div class="form-group">
    <div class="col-md-8">
      <label class="col-md-4 control-label" for="COMPANYNAME">Nombre de la Compañía:</label>

      <div class="col-md-8">

        <input type="hidden" name="COMPANYID" value="<?php echo $res->COMPANYID; ?>">
        <input class="form-control input-sm" id="COMPANYNAME" name="COMPANYNAME" placeholder="Nombre de la Compañía" type="text" value="<?php echo $res->COMPANYNAME; ?>">
      </div>
    </div>
  </div>
  <div class="form-group">
    <div class="col-md-8">
      <label class="col-md-4 control-label" for="COMPANYADDRESS">Dirección de la Compañía:</label>
      <div class="col-md-8">
        <textarea class="form-control input-sm" id="COMPANYADDRESS" name="COMPANYADDRESS" placeholder="Dirección de la Compañía" type="text" value="" required onkeyup="javascript:capitalize(this.id, this.value);" autocomplete="off"><?php echo $res->COMPANYADDRESS; ?></textarea>
        <!-- <input class="form-control input-sm" id="COMPANYADDRESS" name="COMPANYADDRESS" placeholder="Company Address" value="<?php echo $res->COMPANYADDRESS; ?>" />  -->
      </div>
    </div>
  </div>
  <div class="form-group">
    <div class="col-md-8">
      <label class="col-md-4 control-label" for="COMPANYCONTACTNO">Nro. de Contacto de la Compañía:</label>

      <div class="col-md-8">
        <input class="form-control input-sm" id="COMPANYCONTACTNO" name="COMPANYCONTACTNO" placeholder="Nro. de Contacto de la Compañía" type="text" value="<?php echo $res->COMPANYCONTACTNO; ?>">
      </div>
    </div>
  </div>


  <!-- STATUS -->
  <!-- <div class="form-group">

  </div> -->


  <!-- USERNAME -->
  <div class="form-group">
    <div class="col-md-8">
      <label class="col-md-4 control-label" for="COMPANYUSER">Username:</label>

      <div class="col-md-8">
        <input name="deptid" type="hidden" value="">
        <input class="form-control input-sm" id="COMPANYUSER" name="COMPANYUSER" placeholder="Nombre de Usuario" type="text" value="<?php echo $res->COMPANYUSER; ?>">
      </div>
    </div>
  </div>


  <!-- PASSWORD -->
  <div class="form-group">
    <div class="col-md-8">
      <label class="col-md-4 control-label" for="COMPANYPASS">Password:</label>

      <div class="col-md-8">
        <input name="deptid" type="hidden" value="">
        <input class="form-control input-sm" id="COMPANYPASS" name="COMPANYPASS" placeholder="Contraseña" type="Password" value="" required>
      </div>
    </div>
  </div>




  <div class="form-group">
    <div class="col-md-8">
      <label class="col-md-4 control-label" for="idno"></label>

      <div class="col-md-8">
        <!-- <a href="index.php" class="btn btn_fixnmix"><span class="glyphicon glyphicon-arrow-left"></span>&nbsp;<strong>Back</strong></a> -->
        <button class="btn btn-primary btn-sm" name="save" type="submit"><span class="fa fa-save fw-fa"></span> Guardar</button>

      </div>
    </div>
  </div>



</form>