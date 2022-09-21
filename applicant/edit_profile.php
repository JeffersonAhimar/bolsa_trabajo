<?php
if (!isset($_SESSION['APPLICANTID'])) {
  redirect(web_root . "index.php");
}

@$APPLICANTID = $_GET['id'];
if ($APPLICANTID == '') {
  redirect("index.php");
}
$user = new Applicants();
$singleuser = $user->single_applicant($APPLICANTID);

?>

<form class="form-horizontal span6" action="controller.php?action=edit_profile" method="POST">

  <fieldset>
    <legend>* Actualizar Mi Perfil</legend>



    <input id="APPLICANTID" name="APPLICANTID" type="Hidden" value="<?php echo $singleuser->APPLICANTID; ?>">
    <!--    </div>
                    </div>
                  </div>      -->

    <div class="form-group">
      <div class="col-md-8">
        <label class="col-md-4 control-label" for="U_LNAME">Nombres:</label>

        <div class="col-md-8">
          <input name="deptid" type="hidden" value="">
          <input class="form-control input-sm" id="U_FNAME" name="U_FNAME" placeholder="Nombres" type="text" value="<?php echo $singleuser->FNAME; ?>">
        </div>
      </div>
    </div>


    <div class="form-group">
      <div class="col-md-8">
        <label class="col-md-4 control-label" for="U_LNAME">Apellidos:</label>

        <div class="col-md-8">
          <input name="deptid" type="hidden" value="">
          <input class="form-control input-sm" id="U_LNAME" name="U_LNAME" placeholder="Apellidos" type="text" value="<?php echo $singleuser->LNAME; ?>">
        </div>
      </div>
    </div>

    <div class="form-group">
      <div class="col-md-8">
        <label class="col-md-4 control-label" for="U_ADDRESS">Dirección:</label>

        <div class="col-md-8">
          <input name="deptid" type="hidden" value="">
          <input class="form-control input-sm" id="U_ADDRESS" name="U_ADDRESS" placeholder="Dirección" type="text" value="<?php echo $singleuser->ADDRESS; ?>">
        </div>
      </div>
    </div>

    <!--  -->
    <?php
    $fecha = $singleuser->BIRTHDATE;
    // $mes_f = $fecha->format('Y-m-d');
    $f_year = date("Y", strtotime($fecha));
    $f_month = date("m", strtotime($fecha));
    $f_day = date("d", strtotime($fecha));
    ?>





    <!--  -->


    <div class="form-group">
      <div class="rows">
        <div class="col-md-8">
          <div class="col-md-4">
            <label class="col-lg-12 control-label">Fecha de Nacimiento :</label>
          </div>

          <div class="col-lg-3">
            <select class="form-control input-sm" name="U_month">
              <option>Month</option>
              <?php

              $mon = array('Jan' => 1, 'Feb' => 2, 'Mar' => 3, 'Apr' => 4, 'May' => 5, 'Jun' => 6, 'Jul' => 7, 'Aug' => 8, 'Sep' => 9, 'Oct' => 10, 'Nov' => 11, 'Dec' => 8);


              foreach ($mon as $month => $value) {

                # code...
                if ($f_month == $value) {
                  // echo "<option value=' . $value . ' selected='true' >" . $month . "</option>";
                  echo "<option value='" . $value . "' selected='true' >" . $month . "</option>";
                } else {
                  echo '<option value=' . $value . '>' . $month . '</option>';
                }
              }
              ?>
            </select>
          </div>

          <div class="col-lg-2">
            <select class="form-control input-sm" name="U_day">
              <option>Day</option>
              <?php
              $d = range(31, 1);
              foreach ($d as $day) {
                // echo '<option value=' . $day . '>' . $day . '</option>';
                if ($f_day == $day) {
                  echo "<option value='" . $day . "' selected='true' >" . $day . "</option>";
                } else {
                  echo '<option value=' . $day . '>' . $day . '</option>';
                }
              }

              ?>

            </select>
          </div>

          <div class="col-lg-3">
            <select class="form-control input-sm" name="U_year">
              <option>Year</option>
              <?php
              $years = range(2010, 1900);
              foreach ($years as $yr) {

                if ($f_year == $yr) {
                  // echo "<option value=' . $yr . ' selected='true' >" . $yr . "</option>";
                  echo "<option value='" . $yr . "' selected='true' >" . $yr . "</option>";
                } else {
                  echo '<option value=' . $yr . '>' . $yr . '</option>';
                }
              }

              ?>

            </select>
          </div>
        </div>
      </div>
    </div>


    <div class="form-group">
      <div class="col-md-8">
        <label class="col-md-4 control-label" for="U_BIRTHPLACE">Lugar de Nacimiento:</label>

        <div class="col-md-8">
          <input name="deptid" type="hidden" value="">
          <input class="form-control input-sm" id="U_BIRTHPLACE" name="U_BIRTHPLACE" placeholder="Apellidos" type="text" value="<?php echo $singleuser->BIRTHPLACE; ?>">
        </div>
      </div>
    </div>

    <div class="form-group">
      <div class="col-md-8">
        <label class="col-md-4 control-label" for="U_SEX">Género:</label>

        <div class="col-md-8">
          <select class="form-control input-sm" name="U_SEX" id="U_SEX">
            <option value="none" <?php echo ($singleuser->SEX == 'None') ? 'selected="true"' : ''; ?>>Seleccionar</option>
            <option value="Masculino" <?php echo ($singleuser->SEX == 'Masculino') ? 'selected="true"' : ''; ?>>Masculino</option>
            <option value="Femenino" <?php echo ($singleuser->SEX == 'Femenino') ? 'selected="true"' : ''; ?>>Femenino</option>

          </select>
        </div>
      </div>
    </div>


    <div class="form-group">
      <div class="col-md-8">
        <label class="col-md-4 control-label" for="U_CONTACTNO">Nro. de Contacto:</label>

        <div class="col-md-8">
          <input name="deptid" type="hidden" value="">
          <input class="form-control input-sm" id="U_CONTACTNO" name="U_CONTACTNO" placeholder="Apellidos" type="text" value="<?php echo $singleuser->CONTACTNO; ?>">
        </div>
      </div>
    </div>

    <div class="form-group">
      <div class="col-md-8">
        <label class="col-md-4 control-label" for="U_CIVILSTATUS">Estado Civil:</label>

        <div class="col-md-8">
          <select class="form-control input-sm" name="U_CIVILSTATUS" id="U_CIVILSTATUS">
            <!-- <option value="none">Seleccionar</option>
            <option value="Single">Soltero(a)</option>
            <option value="Married">Casado(a)</option>
            <option value="Widow">Viudo(a)</option> -->
            <!-- <option value="Fourth" >Fourth</option> -->
            <option value="none" <?php echo ($singleuser->CIVILSTATUS == 'none') ? 'selected="true"' : ''; ?>>Seleccionar</option>
            <option value="Soltero(a)" <?php echo ($singleuser->CIVILSTATUS == 'Soltero(a)') ? 'selected="true"' : ''; ?>>Soltero(a)</option>
            <option value="Casado(a)" <?php echo ($singleuser->CIVILSTATUS == 'Casado(a)') ? 'selected="true"' : ''; ?>>Casado(a)</option>
            <option value="Viudo(a)" <?php echo ($singleuser->CIVILSTATUS == 'Viudo(a)') ? 'selected="true"' : ''; ?>>Viudo(a)</option>
          </select>
        </div>
      </div>
    </div>

    <div class="form-group">
      <div class="col-md-8">
        <label class="col-md-4 control-label" for="U_EMAILADDRESS">Correo Electrónico:</label>

        <div class="col-md-8">
          <input name="deptid" type="hidden" value="">
          <input class="form-control input-sm" id="U_EMAILADDRESS" name="U_EMAILADDRESS" placeholder="Apellidos" type="text" value="<?php echo $singleuser->EMAILADDRESS; ?>">
        </div>
      </div>
    </div>



    <div class="form-group">
      <div class="col-md-8">
        <label class="col-md-4 control-label" for="U_USERNAME">Username:</label>

        <div class="col-md-8">
          <input name="deptid" type="hidden" value="">
          <input class="form-control input-sm" id="U_USERNAME" name="U_USERNAME" placeholder="Email Address" type="text" value="<?php echo $singleuser->USERNAME; ?>">
        </div>
      </div>
    </div>

    <div class="form-group">
      <div class="col-md-8">
        <label class="col-md-4 control-label" for="U_PASS">Password:</label>

        <div class="col-md-8">
          <input name="deptid" type="hidden" value="">
          <input class="form-control input-sm" id="U_PASS" name="U_PASS" placeholder="Account Password" type="Password" value="" required>
        </div>
      </div>
    </div>

    <div class="form-group">
      <div class="col-md-8">
        <label class="col-md-4 control-label" for="U_DEGREE">Estudios:</label>

        <div class="col-md-8">
          <input name="deptid" type="hidden" value="">
          <input class="form-control input-sm" id="U_DEGREE" name="U_DEGREE" placeholder="DEGREE" type="text" value="<?php echo $singleuser->DEGREE; ?>">
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


  </fieldset>


</form>


</div>
<!--End of container-->