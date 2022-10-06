<?php
if (!isset($_SESSION['ADMIN_COMPANYID'])) {
  redirect(web_root . "admin/index.php");
}

@$USERID = $_SESSION['ADMIN_COMPANYID'];
if ($USERID == '') {
  redirect("index.php");
}
$user = new Company();
$singleuser = $user->single_user($USERID);


?>

<script src="<?php web_root . 'plugins/jQuery/jquery-3.6.1.min.js'; ?>"></script>

<script>
  var url = "controller.php";
  var type = "POST";

  function cambiaDepartamento() {
    var idPais = $("#U_PAIS").val();
    $.ajax({
      type: type,
      url: url,
      data: {
        op: '1',
        idPais: idPais
      },
      success: function(result) {
        $("#U_DEPARTAMENTO").html(result);
        cambiaProvincia();
        cambiaDistrito();
      }
    });
  }

  function cambiaProvincia() {
    var idDepartamento = $("#U_DEPARTAMENTO").val();
    $.ajax({
      type: type,
      url: url,
      data: {
        op: '2',
        idDepartamento: idDepartamento
      },
      success: function(result) {
        $("#U_PROVINCIA").html(result);
        cambiaDistrito();
      }
    });
  }

  function cambiaDistrito() {
    var idProvincia = $("#U_PROVINCIA").val();
    $.ajax({
      type: type,
      url: url,
      data: {
        op: '3',
        idProvincia: idProvincia
      },
      success: function(result) {
        $("#U_DISTRITO").html(result);
      }
    });
  }
</script>




<div class="container">
  <div class="panel-body inf-content">
    <div class="row">
      <div class="col-md-4">

      </div>
      <div class="col-md-6">
        <h1><strong>Perfil de la Compañía</strong></h1><br>
        <form class="form-horizontal span6" action="controller.php?action=edit&view=" method="POST">


          <input id="COMPANYID" name="COMPANYID" type="Hidden" value="<?php echo $singleuser->COMPANYID; ?>">


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

          <!-- RUC -->
          <div class="form-group">
            <div class="col-md-8">
              <label class="col-md-4 control-label" for="U_RUC">RUC:</label>

              <div class="col-md-8">
                <input name="deptid" type="hidden" value="">
                <input class="form-control input-sm" id="U_RUC" name="U_RUC" placeholder="RUC" type="text" value="<?php echo $singleuser->COMPANYRUC; ?>">
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


          <!-- PAIS -->

          <div class="form-group">
            <div class="col-md-8">
              <label class="col-md-4 control-label" for="U_PAIS">País:</label>
              <div class="col-md-8">
                <select class="form-control input-sm" id="U_PAIS" name="U_PAIS" onchange="cambiaDepartamento()" required="">
                  <option value="">Seleccione el País</option>
                  <?php
                  $sql = "SELECT * FROM tblpais";
                  $mydb->setQuery($sql);
                  $cur  = $mydb->loadResultList();
                  foreach ($cur as $row) {
                    # code...
                    if ($row->idPais == $singleuser->COMPANYPAIS) {
                      echo '<option value=' . $row->idPais . ' selected="true">' . $row->pais . '</option>';
                    } else {
                      echo '<option value=' . $row->idPais . '>' . $row->pais . '</option>';
                    }
                  }
                  ?>
                </select>
              </div>
            </div>
          </div>

          <!-- DEPARTAMENTO -->

          <div class="form-group">
            <div class="col-md-8">
              <label class="col-md-4 control-label" for="U_DEPARTAMENTO">Departamento:</label>
              <div class="col-md-8">
                <select class="form-control input-sm" id="U_DEPARTAMENTO" name="U_DEPARTAMENTO" onchange="cambiaProvincia()" required="">
                  <option value="">Seleccione el Departamento</option>
                  <?php
                  $sql = "SELECT * FROM `tbldepartamentos` WHERE `idPais` = '" . $singleuser->COMPANYPAIS . "'";
                  $mydb->setQuery($sql);
                  $cur  = $mydb->loadResultList();
                  foreach ($cur as $row) {
                    # code...
                    if ($row->idDepartamento == $singleuser->COMPANYDEPARTAMENTO) {
                      echo '<option value=' . $row->idDepartamento . ' selected="true">' . $row->departamento . '</option>';
                    } else {
                      echo '<option value=' . $row->idDepartamento . '>' . $row->departamento . '</option>';
                    }
                  }
                  ?>
                </select>
              </div>
            </div>
          </div>

          <!-- PROVINCIA -->
          <div class="form-group">
            <div class="col-md-8">
              <label class="col-md-4 control-label" for="U_PROVINCIA">Provincia:</label>
              <div class="col-md-8">
                <select class="form-control input-sm" id="U_PROVINCIA" name="U_PROVINCIA" onchange="cambiaDistrito()" required="">
                  <option>Seleccione la Provincia</option>
                  <?php
                  $sql = "SELECT * FROM tblprovincia WHERE idDepartamento = " . $singleuser->COMPANYDEPARTAMENTO;
                  $mydb->setQuery($sql);
                  $cur  = $mydb->loadResultList();
                  foreach ($cur as $row) {
                    # code...
                    if ($row->idProvincia == $singleuser->COMPANYPROVINCIA) {
                      echo '<option value=' . $row->idProvincia . ' selected="true">' . $row->provincia . '</option>';
                    } else {
                      echo '<option value=' . $row->idProvincia . '>' . $row->provincia . '</option>';
                    }
                  }
                  ?>
                </select>
              </div>
            </div>
          </div>

          <!-- DISTRITO -->
          <div class="form-group">
            <div class="col-md-8">
              <label class="col-md-4 control-label" for="U_DISTRITO">Distrito:</label>
              <div class="col-md-8">
                <select class="form-control input-sm" id="U_DISTRITO" name="U_DISTRITO" required="">
                  <option>Seleccione el Distrito</option>
                  <?php
                  $sql = "SELECT * FROM tbldistrito WHERE idProvincia = " . $singleuser->COMPANYPROVINCIA;
                  $mydb->setQuery($sql);
                  $cur  = $mydb->loadResultList();
                  foreach ($cur as $row) {
                    # code...
                    if ($row->idDistrito == $singleuser->COMPANYDISTRITO) {
                      echo '<option value=' . $row->idDistrito . ' selected="true">' . $row->distrito . '</option>';
                    } else {
                      echo '<option value=' . $row->idDistrito . '>' . $row->distrito . '</option>';
                    }
                  }
                  ?>
                </select>
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


<script>
  window.addEventListener('load', function() {
    console.log('La página ha terminado de cargarse!!');
    // cambiaProvincia();

  });
</script>