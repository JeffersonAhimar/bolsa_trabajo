<?php
require_once("../include/initialize.php");

?>
<?php
// login confirmation
if (isset($_SESSION['COMPANYID'])) {
  redirect(web_root . "company/vacancy/");
}
?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Compañía | Ingresar</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.5 -->
  <link rel="stylesheet" href="<?php echo web_root; ?>bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo web_root; ?>plugins/font-awesome/css/font-awesome.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo web_root; ?>dist/css/AdminLTE.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="<?php echo web_root; ?>plugins/iCheck/square/blue.css">
  <link rel="icon" type="image/x-icon" href="<?php echo web_root; ?>/plugins/home-plugins/img/favicon.png">
</head>

<body class="hold-transition login-page">
  <div class="login-box">
    <div class="login-box-body" style="min-height: 280px;">
      <h1 class="login-box-msg">Login - Compañía</h1>
      <hr />
      <p><?php check_message(); ?></p>

      <form action="" method="post">
        <div class="form-group has-feedback">
          <input type="text" class="form-control" placeholder="Nombre de Usuario" name="user_email">
          <span class="glyphicon glyphicon-user form-control-feedback"></span>
        </div>
        <div class="form-group has-feedback">
          <input type="password" class="form-control" placeholder="Contraseña" name="user_pass">
          <span class="glyphicon glyphicon-lock form-control-feedback"></span>
        </div>
        <div class="row">
          <div class="col-xs-6">
            <button type="submit" name="btnLogin" class="btn btn-primary btn-block btn-flat">Ingresar</button>
            <br>
            <a href="<?php echo web_root; ?>index.php?q=register" class="text-center" target="_self">¿No estás registrado?</a>
          </div>
        </div>
      </form>
    </div>
  </div>


  <?php

  if (isset($_POST['btnLogin'])) {
    $email = trim($_POST['user_email']);
    $upass  = trim($_POST['user_pass']);
    $h_upass = sha1($upass);

    if ($email == '' or $upass == '') {

      message("Nombre de Usuario y Contraseña Inválidos!", "error");
      redirect("login.php");
    } else {
      //it creates a new objects of member
      $user = new Company();
      //make use of the static function, and we passed to parameters
      $res = $user->userAuthentication($email, $h_upass);
      if ($res == true) {
        // message("You logon as " . $_SESSION['ROLE'] . ".", "success");

        $_SESSION['ADMIN_COMPANYID'] = $_SESSION['COMPANYID'];
        $_SESSION['ADMIN_COMPANYNAME'] = $_SESSION['COMPANYNAME'];
        $_SESSION['ADMIN_COMPANYUSER'] = $_SESSION['COMPANYUSER'];
        // $_SESSION['ADMIN_COMPANYPASS'] = $_SESSION['COMPANYPASS'];

        unset($_SESSION['COMPANYID']);
        unset($_SESSION['COMPANYNAME']);
        unset($_SESSION['COMPANYUSER']);
        // unset($_SESSION['COMPANYPASS']);

        redirect(web_root . "company/vacancy/");
        // } 
      } else {
        message("Error. Por favor contacta al administrador!", "error");
        redirect(web_root . "company/login.php");
      }
    }
  }
  ?>


  <!-- jQuery 2.1.4 -->
  <script src="<?php echo web_root; ?>plugins/jQuery/jQuery-2.1.4.min.js"></script>
  <!-- Bootstrap 3.3.5 -->
  <script src="<?php echo web_root; ?>bootstrap/js/bootstrap.min.js"></script>
  <!-- iCheck -->
  <script src="<?php echo web_root; ?>plugins/iCheck/icheck.min.js"></script>
  <script>
    $(function() {
      $('input').iCheck({
        checkboxClass: 'icheckbox_square-blue',
        radioClass: 'iradio_square-blue',
        increaseArea: '20%' // optional
      });
    });
  </script>
</body>

</html>