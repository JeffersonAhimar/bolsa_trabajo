<?php
if (!isset($_SESSION['ADMIN_USERID'])) {
  redirect(web_root . "admin/index.php");
}

$autonum = new Autonumber();
$res = $autonum->set_autonumber('APPLICANTID');

?>

<section id="feature" class="transparent-bg">
  <div class="container">
    <div class="center wow fadeInDown">
      <h2 class="page-header">Añadir Nuevo Usuario</h2>
    </div>

    <div class="row">
      <div class="features">

        <form class="form-horizontal span6  wow fadeInDown" action="controller.php?action=add" method="POST">

          <div class="form-group">
            <div class="col-md-8">
              <label class="col-md-4 control-label" for="APPLICANTID">ID del Usuario:</label>

              <div class="col-md-8">
                <!-- <input class="form-control input-sm" id="APPLICANTID" name="APPLICANTID" placeholder=
                              "Employee No" type="text" value="<?php echo $res->AUTO; ?>"> -->
                <input class="form-control input-sm" id="APPLICANTID" name="APPLICANTID" placeholder="ID del Usuario" type="text" value="">
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="col-md-8">
              <label class="col-md-4 control-label" for="FNAME">Primer Nombre:</label>

              <div class="col-md-8">
                <input name="deptid" type="hidden" value="">
                <input class="form-control input-sm" id="FNAME" name="FNAME" placeholder="Primer Nombre" type="text" value="" autocomplete="off">
              </div>
            </div>
          </div>

          <div class="form-group">
            <div class="col-md-8">
              <label class="col-md-4 control-label" for="LNAME">Apellidos:</label>

              <div class="col-md-8">
                <input name="deptid" type="hidden" value="">
                <input class="form-control input-sm" id="LNAME" name="LNAME" placeholder="Apellidos" autocomplete="off">
              </div>
            </div>
          </div>

          <div class="form-group">
            <div class="col-md-8">
              <label class="col-md-4 control-label" for="MNAME">Segundo Nombre:</label>

              <div class="col-md-8">
                <input name="deptid" type="hidden" value="">
                <input class="form-control input-sm" id="MNAME" name="MNAME" placeholder="Segundo Nombre" autocomplete="off">
                <!-- <input class="form-control input-sm" id="DEPARTMENT_DESC" name="DEPARTMENT_DESC" placeholder=
                              "Description" type="text" value=""> -->
              </div>
            </div>
          </div>

          <div class="form-group">
            <div class="col-md-8">
              <label class="col-md-4 control-label" for="ADDRESS">Dirección:</label>

              <div class="col-md-8">

                <textarea class="form-control input-sm" id="ADDRESS" name="ADDRESS" placeholder="Dirección" type="text" value="" required autocomplete="off"></textarea>
              </div>
            </div>
          </div>

          <div class="form-group">
            <div class="col-md-8">
              <label class="col-md-4 control-label" for="Gender">Género:</label>

              <div class="col-md-8">
                <div class="col-lg-5">
                  <div class="radio">
                    <label><input checked id="optionsRadios1" checked="True" name="optionsRadios" type="radio" value="Female">Femenino</label>
                  </div>
                </div>

                <div class="col-lg-4">
                  <div class="radio">
                    <label><input id="optionsRadios2" name="optionsRadios" type="radio" value="Male"> Masculino</label>
                  </div>
                </div>

              </div>
            </div>
          </div>

          <div class="form-group">
            <div class="col-md-8">
              <label class="col-md-4 control-label" for="BIRTHDATE">Fecha de Nacimiento:</label>

              <div class="col-md-8">
                <div class="input-group">
                  <span class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </span>
                  <input class="form-control input-sm date_picker" id="BIRTHDATE" name="BIRTHDATE" placeholder="Fecha de Nacimiento" type="text" value="" required autocomplete="off">
                </div>
              </div>
            </div>
          </div>

          <div class="form-group">
            <div class="col-md-8">
              <label class="col-md-4 control-label" for="BIRTHPLACE">Lugar de Nacimiento:</label>

              <div class="col-md-8">

                <textarea class="form-control input-sm" id="BIRTHPLACE" name="BIRTHPLACE" placeholder="Lugar de Nacimiento" type="text" value="" required autocomplete="off"></textarea>
              </div>
            </div>
          </div>


          <div class="form-group">
            <div class="col-md-8">
              <label class="col-md-4 control-label" for="TELNO">Nro. de Contacto:</label>

              <div class="col-md-8">

                <input class="form-control input-sm" id="TELNO" name="TELNO" placeholder="Nro. de Contacto" type="text" any value="" required autocomplete="off">
              </div>
            </div>
          </div>

          <div class="form-group">
            <div class="col-md-8">
              <label class="col-md-4 control-label" for="CIVILSTATUS">Estado Civil:</label>

              <div class="col-md-8">
                <select class="form-control input-sm" name="CIVILSTATUS" id="CIVILSTATUS">
                  <option value="none">Seleccionar</option>
                  <option value="Single">Soltero(a)</option>
                  <option value="Married">Cazado(a)</option>
                  <option value="Widow">Viudo(a)</option>
                  <!-- <option value="Fourth" >Fourth</option> -->
                </select>
              </div>
            </div>
          </div>

          <div class="form-group">
            <div class="col-md-8">
              <label class="col-md-4 control-label" for="POSITION">Posición:</label>

              <div class="col-md-8">

                <input class="form-control input-sm" id="POSITION" name="POSITION" placeholder="Posición" type="text" any value="" required autocomplete="off">
              </div>
            </div>
          </div>

          <!--     <div class="form-group">
                              <div class="col-md-8">
                                <label class="col-md-4 control-label" for=
                                "WORKSTATS">Work Status:</label>

                                <div class="col-md-8">
                                  <select class="form-control input-sm" name="WORKSTATS" id="WORKSTATS">
                                      <option value="none" >Select</option>
                                      <option value="Regular">Temporary</option> 
                                      <option value="Regular">Regular</option>
                                      <option value="Probationary">Probationary</option> 
                                  </select> 
                                </div>
                              </div>
                            </div> -->
          <div class="form-group">
            <div class="col-md-8">
              <label class="col-md-4 control-label" for="EMP_HIREDDATE">Fecha de Contratación:</label>
              <div class="col-md-8">
                <div class="input-group date  " data-provide="datepicker" data-date="2012-12-21T15:25:00Z">
                  <input type="input" class="form-control input-sm date_picker" id="HIREDDATE" name="EMP_HIREDDATE" placeholder="mm/dd/yyyy" autocomplete="false" />
                  <span class="input-group-addon"><i class="fa fa-th"></i></span>
                </div>
              </div>
            </div>
          </div>


          <div class="form-group">
            <div class="col-md-8">
              <label class="col-md-4 control-label" for="EMP_EMAILADDRESS">Correo Electrónico:</label>
              <div class="col-md-8">
                <input type="Email" class="form-control input-sm" id="EMP_EMAILADDRESS" name="EMP_EMAILADDRESS" placeholder="Correo Electrónico" autocomplete="false" />
              </div>
            </div>
          </div>

          <div class="form-group">
            <div class="col-md-8">
              <label class="col-md-4 control-label" for="COMPANYNAME">Nombre de la Compañía:</label>

              <div class="col-md-8">
                <select class="form-control input-sm" id="COMPANYID" name="COMPANYID">
                  <option value="None">Seleccionar</option>
                  <?php
                  $sql = "Select * From tblcompany";
                  $mydb->setQuery($sql);
                  $res  = $mydb->loadResultList();
                  foreach ($res as $row) {
                    # code...
                    echo '<option value=' . $row->COMPANYID . '>' . $row->COMPANYNAME . '</option>';
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
                <button class="btn btn-primary btn-sm" name="save" type="submit"><span class="fa fa-save fw-fa"></span> Guardar</button>
                <!-- <a href="index.php" class="btn btn-info"><span class="glyphicon glyphicon-arrow-left"></span>&nbsp;<strong>Back</strong></a> -->

              </div>
            </div>
          </div>


        </form>



      </div>
      <!--/.services-->
    </div>
    <!--/.row-->
  </div>
  <!--/.container-->
</section>
<!--/#feature-->