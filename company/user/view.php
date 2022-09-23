<?php
if (!isset($_SESSION['ADMIN_COMPANYID'])) {
  redirect(web_root . "admin/index.php");
}
// if (!$_SESSION['ADMIN_ROLE'] == 'Administrator') {
//   redirect(web_root . "admin/index.php");
// }
@$USERID = $_SESSION['ADMIN_COMPANYID'];
if ($USERID == '') {
  redirect("index.php");
}
$user = new Company();
$singleuser = $user->single_user($USERID);


?>
<div class="container">
  <div class="panel-body inf-content">
    <div class="row">
      <div class="col-md-4">
        <!-- <a  data-target="#myModal" data-toggle="modal" href="" title="Click here to Change Image." >
           <img alt="" style="width:500px; height:400px;>" title="" class="img-circle img-thumbnail isTooltip" src="<?php echo web_root . 'admin/user/' . $singleuser->PICLOCATION; ?>" data-original-title="Usuario">
        </a> -->
      </div>
      <div class="col-md-6">
        <h1><strong>Perfil de la Compañía</strong></h1><br>
        <form class="form-horizontal span6" action="controller.php?action=edit&view=" method="POST">


          <!-- <div class="form-group">
                    <div class="col-md-8">
                      <label class="col-md-4 control-label" for=
                      "user_id">User Id:</label> -->

          <!-- <div class="col-md-8"> -->

          <input id="COMPANYID" name="COMPANYID" type="Hidden" value="<?php echo $singleuser->COMPANYID; ?>">
          <!--    </div>
                    </div>
                  </div>      -->

          <!-- NOMBRE -->
          <div class="form-group">
            <div class="col-md-8">
              <label class="col-md-4 control-label" for="U_NAME">Nombre:</label>

              <div class="col-md-8">
                <input name="deptid" type="hidden" value="">
                <input class="form-control input-sm" id="U_NAME" name="U_NAME" placeholder="Nombre" type="text" value="<?php echo $singleuser->COMPANYNAME; ?>">
              </div>
            </div>
          </div>

          <!-- ADDRESS -->
          <div class="form-group">
            <div class="col-md-8">
              <label class="col-md-4 control-label" for="U_ADDRESS">Dirección:</label>

              <div class="col-md-8">
                <input name="deptid" type="hidden" value="">
                <input class="form-control input-sm" id="U_ADDRESS" name="U_ADDRESS" placeholder="Dirección" type="text" value="<?php echo $singleuser->COMPANYADDRESS; ?>">
              </div>
            </div>
          </div>

          <!-- CONTACTNO -->
          <div class="form-group">
            <div class="col-md-8">
              <label class="col-md-4 control-label" for="U_CONTACTNO">Nro. de Contacto:</label>

              <div class="col-md-8">
                <input name="deptid" type="hidden" value="">
                <input class="form-control input-sm" id="U_CONTACTNO" name="U_CONTACTNO" placeholder="Nro. de Contacto" type="text" value="<?php echo $singleuser->COMPANYCONTACTNO; ?>">
              </div>
            </div>
          </div>



          <div class="form-group">
            <div class="col-md-8">
              <label class="col-md-4 control-label" for="U_USERNAME">Nombre de Usuario:</label>

              <div class="col-md-8">
                <input name="deptid" type="hidden" value="">
                <input class="form-control input-sm" id="U_USERNAME" name="U_USERNAME" placeholder="Nombre de Usuario" type="text" value="<?php echo $singleuser->COMPANYUSER; ?>">
              </div>
            </div>
          </div>

          <div class="form-group">
            <div class="col-md-8">
              <label class="col-md-4 control-label" for="U_PASS">Contraseña:</label>

              <div class="col-md-8">
                <input name="deptid" type="hidden" value="">
                <input class="form-control input-sm" id="U_PASS" name="U_PASS" placeholder="Contraseña" type="Password" value="" required>
              </div>
            </div>
          </div>


          <div class="form-group">
            <div class="col-md-8">
              <label class="col-md-4 control-label" for="idno"></label>

              <div class="col-md-8">
                <button class="btn btn-primary " name="save" type="submit"><span class="fa fa-save fw-fa"></span> Guardar</button>
                <!-- <a href="index.php" class="btn btn-info"><span class="fa fa-arrow-circle-left fw-fa"></span>&nbsp;<strong>List of Users</strong></a> -->
              </div>
            </div>
          </div>



        </form>


      </div>
    </div>
  </div>
</div>


<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button class="close" data-dismiss="modal" type="button">×</button>

        <h4 class="modal-title" id="myModalLabel">Choose Image.</h4>
      </div>

      <form action="controller.php?action=photos" enctype="multipart/form-data" method="post">
        <div class="modal-body">
          <div class="form-group">
            <div class="rows">
              <div class="col-md-12">
                <div class="rows">
                  <div class="col-md-8">
                    <input class="mealid" type="hidden" name="mealid" id="mealid" value="">
                    <input name="MAX_FILE_SIZE" type="hidden" value="1000000"> <input id="photo" name="photo" type="file">
                  </div>

                  <div class="col-md-4"></div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="modal-footer">
          <button class="btn btn-default" data-dismiss="modal">Close</button> <button class="btn btn-primary" name="savephoto" type="submit">Upload Photo</button>
        </div>
      </form>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->