<?php
if (!isset($_SESSION['ADMIN_USERID'])) {
  redirect(web_root . "admin/index.php");
}

?>

<script src="<?php web_root . 'plugins/jQuery/jquery-3.6.1.min.js'; ?>"></script>

<script>
  var url = "controller.php";
  var type = "POST";

  function cambiaDepartamento() {
    var idPais = $("#COMPANYPAIS").val();
    $.ajax({
      type: type,
      url: url,
      data: {
        op: '1',
        idPais: idPais
      },
      success: function(result) {
        $("#COMPANYDEPARTAMENTO").html(result);
        cambiaProvincia();
        cambiaDistrito();
      }
    });
  }

  function cambiaProvincia() {
    var idDepartamento = $("#COMPANYDEPARTAMENTO").val();
    $.ajax({
      type: type,
      url: url,
      data: {
        op: '2',
        idDepartamento: idDepartamento
      },
      success: function(result) {
        $("#COMPANYPROVINCIA").html(result);
        cambiaDistrito();
      }
    });
  }

  function cambiaDistrito() {
    var idProvincia = $("#COMPANYPROVINCIA").val();
    $.ajax({
      type: type,
      url: url,
      data: {
        op: '3',
        idProvincia: idProvincia
      },
      success: function(result) {
        $("#COMPANYDISTRITO").html(result);
      }
    });
  }
</script>

<form class="form-horizontal span6" action="controller.php?action=add" method="POST">

  <div class="row">
    <div class="col-lg-12">
      <h1 class="page-header">Añadir Nueva Compañía</h1>
    </div>
    <!-- /.col-lg-12 -->
  </div>

  <div class="form-group">
    <div class="col-md-8">
      <label class="col-md-4 control-label" for="COMPANYNAME">Nombre de la Compañía:</label>

      <div class="col-md-8">
        <input class="form-control input-sm" id="COMPANYNAME" name="COMPANYNAME" placeholder="Nombre de la Compañía" type="text" value="" autocomplete="none">
      </div>
    </div>
  </div>

  <div class="form-group">
    <div class="col-md-8">
      <label class="col-md-4 control-label" for="COMPANYADDRESS">Dirección de la Compañía:</label>
      <div class="col-md-8">
        <textarea class="form-control input-sm" id="COMPANYADDRESS" name="COMPANYADDRESS" placeholder="Dirección de la Compañía" type="text" value="" required onkeyup="javascript:capitalize(this.id, this.value);" autocomplete="off"></textarea>
      </div>
    </div>
  </div>


  <div class="form-group">
    <div class="col-md-8">
      <label class="col-md-4 control-label" for="COMPANYRUC">RUC:</label>
      <div class="col-md-8">
        <input class="form-control input-sm" id="COMPANYRUC" name="COMPANYRUC" placeholder="RUC" type="text" value="">
      </div>
    </div>
  </div>

  <!--  -->
  <div class="form-group">
    <div class="col-md-8">
      <label class="col-md-4 control-label" for="COMPANYPAIS">País:</label>
      <div class="col-md-8">
        <select class="form-control input-sm" id="COMPANYPAIS" name="COMPANYPAIS" onchange="cambiaDepartamento()" required="">
          <option value="">Seleccione el Pais</option>
          <?php
          $sql = "SELECT * FROM tblpais";
          $mydb->setQuery($sql);
          $res  = $mydb->loadResultList();
          foreach ($res as $row) {
            # code...
            echo '<option value=' . $row->idPais . '>' . $row->pais . '</option>';
          }
          ?>
        </select>
      </div>
    </div>
  </div>

  <div class="form-group">
    <div class="col-md-8">
      <label class="col-md-4 control-label" for="COMPANYDEPARTAMENTO">Departamento:</label>
      <div class="col-md-8">
        <select class="form-control input-sm" id="COMPANYDEPARTAMENTO" name="COMPANYDEPARTAMENTO" onchange="cambiaProvincia()" required="">
          <option value="">Seleccione el Departamento</option>
        </select>
      </div>
    </div>
  </div>

  <div class="form-group">
    <div class="col-md-8">
      <label class="col-md-4 control-label" for="COMPANYPROVINCIA">Provincia:</label>
      <div class="col-md-8">
        <select class="form-control input-sm" id="COMPANYPROVINCIA" name="COMPANYPROVINCIA" onchange="cambiaDistrito()" required="">
          <option value="">Seleccione la Provincia</option>
        </select>
      </div>
    </div>
  </div>

  <div class="form-group">
    <div class="col-md-8">
      <label class="col-md-4 control-label" for="COMPANYDISTRITO">Distrito:</label>
      <div class="col-md-8">
        <select class="form-control input-sm" id="COMPANYDISTRITO" name="COMPANYDISTRITO" required="">
          <option value="">Seleccione el Distrito</option>
        </select>
      </div>
    </div>
  </div>

  <!--  -->


  <div class="form-group">
    <div class="col-md-8">
      <label class="col-md-4 control-label" for="COMPANYCONTACTNO">Nro. de Contacto de la Compañía:</label>

      <div class="col-md-8">
        <input class="form-control input-sm" id="COMPANYCONTACTNO" name="COMPANYCONTACTNO" placeholder="Nro. de Contacto de la Compañía" type="text" value="" autocomplete="none">
      </div>
    </div>
  </div>

  <!-- STATUS -->
  <div class="form-group">
    <div class="col-md-8">
      <label class="col-md-4 control-label" for="COMPANYSTATUS">Estado:</label>
      <div class="col-md-8">
        <select class="form-control input-sm" id="COMPANYSTATUS" name="COMPANYSTATUS">
          <option value="deshabilitado" selected>deshabilitado</option>
          <option value="habilitado">habilitado</option>
        </select>
      </div>
    </div>
  </div>


  <!-- USERNAME -->
  <div class="form-group">
    <div class="col-md-8">
      <label class="col-md-4 control-label" for="COMPANYUSER">Nombre de Usuario:</label>

      <div class="col-md-8">
        <input name="deptid" type="hidden" value="">
        <input class="form-control input-sm" id="COMPANYUSER" name="COMPANYUSER" placeholder="Nombre de Usuario" type="text" value="">
      </div>
    </div>
  </div>


  <!-- PASSWORD -->
  <div class="form-group">
    <div class="col-md-8">
      <label class="col-md-4 control-label" for="COMPANYPASS">Contraseña:</label>

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
        <button class="btn btn-primary btn-sm" name="save" type="submit"><span class="fa fa-save fw-fa"></span> Guardar</button>
        <!-- <a href="index.php" class="btn btn-info"><span class="glyphicon glyphicon-arrow-left"></span>&nbsp;<strong>Back</strong></a> -->

      </div>
    </div>
  </div>


</form>