<?php
if (!isset($_SESSION['ADMIN_USERID'])) {
  redirect(web_root . "admin/index.php");
}
if (!$_SESSION['ADMIN_ROLE'] == 'Administrador') {
  redirect(web_root . "admin/index.php");
}
@$USERID = $_SESSION['ADMIN_USERID'];
if ($USERID == '') {
  redirect("index.php");
}
$user = new User();
$singleuser = $user->single_user($USERID);


?>
<div class="container">
  <div class="panel-body inf-content">
    <div class="row">
      <div class="col-md-4">

      </div>
      <div class="col-md-6">
        <h1><strong>Perfil del Administrador</strong></h1><br>
        <form class="form-horizontal span6" action="controller.php?action=edit&view=" method="POST">

          <input id="USERID" name="USERID" type="Hidden" value="<?php echo $singleuser->USERID; ?>">

          <div class="form-group">
            <div class="col-md-8">
              <label class="col-md-4 control-label" for="U_NAME">Nombre:</label>

              <div class="col-md-8">
                <input name="deptid" type="hidden" value="">
                <input class="form-control input-sm" id="U_NAME" name="U_NAME" placeholder="Nombre" type="text" value="<?php echo $singleuser->FULLNAME; ?>">
              </div>
            </div>
          </div>

          <div class="form-group">
            <div class="col-md-8">
              <label class="col-md-4 control-label" for="U_USERNAME">Nombre de Usuario:</label>

              <div class="col-md-8">
                <input name="deptid" type="hidden" value="">
                <input class="form-control input-sm" id="U_USERNAME" name="U_USERNAME" placeholder="Nombre de Usuario" type="text" value="<?php echo $singleuser->USERNAME; ?>">
              </div>
            </div>
          </div>

          <div class="form-group">
            <div class="col-md-8">
              <label class="col-md-4 control-label" for="U_PASS">Contraseña:</label>

              <div class="col-md-8">
                <input name="deptid" type="hidden" value="">
                <input class="form-control input-sm" id="U_PASS" name="U_PASS" placeholder="Contraseña" type="password" value="" required>
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="col-md-8">
              <label class="col-md-4 control-label" for="U_ROLE">Rol:</label>

              <div class="col-md-8">
                <select class="form-control input-sm" name="U_ROLE" id="U_ROLE">

                  <?php
                  if ($singleuser->ROLE == 'Administrador') {
                    echo "<option value='Administrador' selected>Administrador</option>";
                    echo "<option value='IESTP' >IESTP</option>";
                  } else {
                    echo "<option value='IESTP' selected>IESTP</option>";
                  }
                  ?>

                </select>
              </div>
            </div>
          </div>


          <div class="form-group">
            <div class="col-md-8">
              <label class="col-md-4 control-label" for="idno"></label>

              <div class="col-md-8">
                <button class="btn btn-primary " name="save" type="submit"><span class="fa fa-save fw-fa"></span> Guardar</button>
              </div>
            </div>
          </div>



        </form>


      </div>
    </div>
  </div>
</div>