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
    <legend> Actualizar Perfil <?php echo $APPLICANTID; ?></legend>



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
          <input class="form-control input-sm" id="U_ADDRESS" name="U_ADDRESS" placeholder="Apellidos" type="text" value="<?php echo $singleuser->ADDRESS; ?>">
        </div>
      </div>
    </div>

    <!--  -->
    <?php
    $fecha = $singleuser->BIRTTHDATE;
    $mes_f = $fecha->format('m');


    ?>
    <div class="form-group">
      <div class="col-md-8">
        <label class="col-md-4 control-label" for="U_ADDRESS">MES:</label>

        <div class="col-md-8">
          <input name="deptid" type="hidden" value="">
          <input class="form-control input-sm" id="U_ADDRESS" name="U_ADDRESS" placeholder="Apellidos" type="text" value="<?php echo $singleuser->BIRTHDATE; ?>">
          <input class="form-control input-sm" id="U_ADDRESS" name="U_ADDRESS" placeholder="Apellidos" type="text" value="<?php echo $mes_f; ?>">
        </div>
      </div>
    </div>




    <!--  -->
    

    <div class="form-group">
      <div class="rows">
        <div class="col-md-8">
          <div class="col-md-4">
            <label class="col-lg-12 control-label">Date of Birth :</label>
          </div>

          <div class="col-lg-3">
            <select class="form-control input-sm" name="month">
              <option>Month</option>
              <?php

              $mon = array('Jan' => 1, 'Feb' => 2, 'Mar' => 3, 'Apr' => 4, 'May' => 5, 'Jun' => 6, 'Jul' => 7, 'Aug' => 8, 'Sep' => 9, 'Oct' => 10, 'Nov' => 11, 'Dec' => 8);


              foreach ($mon as $month => $value) {

                # code...
                echo '<option value=' . $value . '>' . $month . '</option>';
              }
              ?>
            </select>
          </div>

          <div class="col-lg-2">
            <select class="form-control input-sm" name="day">
              <option>Day</option>
              <?php
              $d = range(31, 1);
              foreach ($d as $day) {
                echo '<option value=' . $day . '>' . $day . '</option>';
              }

              ?>

            </select>
          </div>

          <div class="col-lg-3">
            <select class="form-control input-sm" name="year">
              <option>Year</option>
              <?php
              $years = range(2010, 1900);
              foreach ($years as $yr) {
                echo '<option value=' . $yr . '>' . $yr . '</option>';
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
            <option value="Male" <?php echo ($singleuser->SEX == 'Male') ? 'selected="true"' : ''; ?>>Male</option>
            <option value="Female" <?php echo ($singleuser->SEX == 'Female') ? 'selected="true"' : ''; ?>>Female</option>
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
        <label class="col-md-4 control-label" for="U_CIVILSTATUS">Civil Status:</label>

        <div class="col-md-8">
          <select class="form-control input-sm" name="U_CIVILSTATUS" id="U_CIVILSTATUS">
            <option value="none">Seleccionar</option>
            <option value="Single">Soltero(a)</option>
            <option value="Married">Casado(a)</option>
            <option value="Widow">Viudo(a)</option>
            <!-- <option value="Fourth" >Fourth</option> -->
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