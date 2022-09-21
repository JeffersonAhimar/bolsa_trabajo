<?php
if (!isset($_SESSION['ADMIN_USERID'])) {
  redirect(web_root . "company/index.php");
}


$companyid = $_GET['id'];
$company = new Company();
$res = $company->single_company($companyid);

?>
<form class="form-horizontal span6" action="controller.php?action=edit_status" method="POST">


  <div class="row">
    <div class="col-lg-12">
      <h1 class="page-header">Actualizar Estado de la Compañía</h1>
    </div>
    <!-- /.col-lg-12 -->
  </div>
  <div class="form-group" >
    <div class="col-md-8">
      <label class="col-md-4 control-label" for="COMPANYNAME">Nombre de la Compañía:</label>

      <div class="col-md-8">

        <input type="hidden" name="COMPANYID" value="<?php echo $res->COMPANYID; ?>">
        <input readonly class="form-control input-sm" id="COMPANYNAME" name="COMPANYNAME" placeholder="Nombre de la Compañía" type="text" value="<?php echo $res->COMPANYNAME; ?>">
      </div>
    </div>
  </div>

<!-- STATUS -->
  <div class="form-group">
    <div class="col-md-8">
      <label class="col-md-4 control-label" for="COMPANYSTATUS">Estado:</label>
      <div class="col-md-8">
        <select class="form-control input-sm" id="COMPANYSTATUS" name="COMPANYSTATUS">
          <option value="disabled" <?php echo ($res->COMPANYSTATUS == 'disabled') ? 'selected="true"' : ''; ?>>disabled</option>
          <option value="enabled" <?php echo ($res->COMPANYSTATUS == 'enabled') ? 'selected="true"' : ''; ?>>enabled</option>
        </select>
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