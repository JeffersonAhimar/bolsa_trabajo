<?php
global $mydb;
$red_id = isset($_GET['id']) ? $_GET['id'] : '';

$jobregistration = new JobRegistration();
$jobreg = $jobregistration->single_jobregistration($red_id);


$applicant = new Applicants_mo();
$appl = $applicant->single_applicant($jobreg->APPLICANTID);

$jobvacancy = new Jobs();
$job = $jobvacancy->single_job($jobreg->JOBID);

$company = new Company();
$comp = $company->single_company($jobreg->COMPANYID);

$sql = "SELECT * FROM `tblattachmentfile` WHERE `FILEID`=" . $jobreg->FILEID;
$mydb->setQuery($sql);
$attachmentfile = $mydb->loadSingleResult();


?>
<style type="text/css">
	.content-header {
		min-height: 50px;
		border-bottom: 1px solid #ddd;
		font-size: 15px;
		font-weight: bold;
	}

	.content-body {
		min-height: 350px;
		/*border-bottom: 1px solid #ddd;*/
	}

	.content-body>p {
		padding: 10px;
		font-size: 12px;
		font-weight: bold;
		border-bottom: 1px solid #ddd;
	}

	.content-footer {
		min-height: 100px;
		border-top: 1px solid #ddd;

	}

	.content-footer>p {
		padding: 5px;
		font-size: 15px;
		font-weight: bold;
	}

	.content-footer textarea {
		width: 100%;
		height: 200px;
	}

	.content-footer .submitbutton {
		margin-top: 20px;
		/*padding: 0;*/

	}
</style>
<form action="controller.php?action=approve" method="POST">
	<div class="col-sm-12 content-header">Ver Detalles</div>
	<div class="col-sm-6 content-body">
		<p>Detalles del Trabajo</p>
		<h3><?php echo $job->OCCUPATIONTITLE; ?></h3>
		<input type="hidden" name="JOBREGID" value="<?php echo $jobreg->REGISTRATIONID; ?>">
		<input type="hidden" name="APPLICANTID" value="<?php echo $appl->APPLICANTID; ?>">

		<div class="col-sm-6">
			<ul>
				<li><i class="fp-ht-bed"></i>Vacantes : <?php echo $job->REQ_NO_EMPLOYEES; ?></li>
				<li><i class="fp-ht-food"></i>Salario : <?php echo number_format($job->SALARIES, 2);  ?></li>
				<li><i class="fa fa-sun-"></i>Duración del Empleo : <?php echo $job->DURATION_EMPLOYEMENT; ?></li>
			</ul>
		</div>
		<div class="col-sm-6">
			<ul>
				<li><i class="fp-ht-tv"></i>Modalidad : <?php echo $job->JOBTYPE; ?></li>
			</ul>
		</div>
		<div class="col-sm-12">
			<p>Descripción del Trabajo : </p>
			<ul>
				<li><?php echo $job->JOBDESCRIPTION; ?></li>
			</ul>
		</div>
		<div class="col-sm-12">
			<p>Calificación/Experiencia Laboral : </p>
			<ul>
				<li>
					<?php echo $job->QUALIFICATION_WORKEXPERIENCE; ?>
				</li>
			</ul>
		</div>
		<div class="col-sm-12">
			<p>Empleador : </p>
			<ul>
				<li><?php echo $comp->COMPANYNAME; ?></li>
				@ <?php echo $comp->COMPANYADDRESS; ?>
		</div>
	</div>
	<div class="col-sm-6 content-body">
		<p>Información del Postulante</p>
		<h3> <?php echo $appl->firstname . ' ' . $appl->lastname; ?></h3>
		<ul>
			<li>Teléfono : <?php echo $appl->phone1; ?></li>
			<li>Teléfono 2 : <?php echo $appl->phone2; ?></li>
			<li>Correo Electrónico : <?php echo $appl->email; ?></li>
			<li>Dirección : <?php echo $appl->address; ?></li>
			<li>Ciudad : <?php echo $appl->city; ?></li>
		</ul>

		<div class="col-sm-12">
			<p>Institución : </p>
			<ul>
				<li>
					<?php echo $appl->institution; ?>
				</li>
			</ul>
		</div>
	</div>


	<div class="col-sm-12 content-footer">
		<p><i class="fa fa-paperclip"></i> Archivos Adjuntos</p>
		<div class="col-sm-12 slider">
			<h3>Revisar CV <a href="<?php echo web_root . 'uploads/documents/' . $attachmentfile->FILE_LOCATION; ?>" target="_blank">Click aquí</a></h3>
		</div>

		<div class="col-sm-12">
			<p>Mensaje</p>
			<textarea class="input-group" name="REMARKS"><?php echo isset($jobreg->REMARKS) ? $jobreg->REMARKS : ""; ?></textarea>
		</div>
		<div class="col-sm-12  submitbutton ">
			<button type="submit" name="submit" class="btn btn-primary">Enviar</button>
		</div>
	</div>

</form>