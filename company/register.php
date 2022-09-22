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
	<title>Compañía | Registro</title>
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

	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>

<body class="hold-transition login-page">
	<section id="content">
		<div class="container content">
			<form class="form-horizontal span6" action="controller.php?action=add" method="POST">

				<div class="row">
					<div class="col-lg-12">
						<h1 class="page-header">Registrar Nueva Compañía</h1>
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
							<!-- <input class="form-control input-sm" id="COMPANYADDRESS" name="COMPANYADDRESS" placeholder="Company Address"   autocomplete="none"/>  -->
						</div>
					</div>
				</div>

				<div class="form-group">
					<div class="col-md-8">
						<label class="col-md-4 control-label" for="COMPANYCONTACTNO">Nro. de Contacto de la Compañía:</label>

						<div class="col-md-8">
							<input class="form-control input-sm" id="COMPANYCONTACTNO" name="COMPANYCONTACTNO" placeholder="Nro. de Contacto de la Compañía" type="text" value="" autocomplete="none">
						</div>
					</div>
				</div>

				<!-- USERNAME -->
				<div class="form-group">
					<div class="col-md-8">
						<label class="col-md-4 control-label" for="COMPANYUSER">Username:</label>

						<div class="col-md-8">
							<input name="deptid" type="hidden" value="">
							<input class="form-control input-sm" id="COMPANYUSER" name="COMPANYUSER" placeholder="Nombre de Usuario" type="text" value="">
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
							<button class="btn btn-primary btn-sm" name="save" type="submit"><span class="fa fa-save fw-fa"></span> Guardar</button>
							<!-- <a href="index.php" class="btn btn-info"><span class="glyphicon glyphicon-arrow-left"></span>&nbsp;<strong>Back</strong></a> -->

						</div>
					</div>
				</div>


			</form>
		</div>
	</section>


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