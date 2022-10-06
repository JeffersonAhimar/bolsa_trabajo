<?php
if (!isset($_SESSION['APPLICANTID'])) {
    # code...
    redirect(web_root . 'index.php');
}
?>
<section id="content">
    <div class="container content">
        <!-- Service Blcoks -->

        <?php
        if (isset($_GET['search'])) {
            # code...
            $category = $_GET['search'];
        } else {
            $category = '';
        }
        // $sql = "SELECT * FROM `tblcompany` c,`tbljob` j WHERE c.`COMPANYID`=j.`COMPANYID` AND CATEGORY LIKE '%" . $category . "%' ORDER BY DATEPOSTED DESC";
        $sql = "SELECT * FROM tblcompany c";
        $sql .= " INNER JOIN tbljob j ON j.COMPANYID=c.COMPANYID";
        $sql .= " INNER JOIN tblpais pa ON pa.idPais=c.COMPANYPAIS";
        $sql .= " INNER JOIN tbldepartamentos d ON d.idDepartamento=c.COMPANYDEPARTAMENTO";
        $sql .= " INNER JOIN tblprovincia pro ON pro.idProvincia=c.COMPANYPROVINCIA";
        $sql .= " INNER JOIN tbldistrito dis ON dis.idDistrito=c.COMPANYDISTRITO";
        $sql .= " WHERE j.CATEGORY = '" . $category . "'";
        $mydb->setQuery($sql);
        $cur = $mydb->loadResultList();


        foreach ($cur as $result) {
        ?>

            <div class="panel panel-primary">
                <div class="panel-header">
                    <div style="border-bottom: 1px solid #ddd;padding: 10px;font-size: 20px;font-weight: bold;color: #000;margin-bottom: 5px;"><a href="<?php echo web_root . 'index.php?q=viewjob&search=' . $result->JOBID; ?>"><?php echo $result->OCCUPATIONTITLE; ?></a>
                    </div>
                </div>
                <div class="panel-body contentbody">
                    <div class="col-sm-10">
                        <div class="col-sm-12">
                            <p>Calificación/Experiencia Laboral :</p>
                            <ul style="list-style: none;">
                                <li><?php echo $result->QUALIFICATION_WORKEXPERIENCE; ?></li>
                            </ul>
                        </div>
                        <div class="col-sm-12">
                            <p>Descripción del Trabajo:</p>
                            <ul style="list-style: none;">
                                <li><?php echo $result->JOBDESCRIPTION; ?></li>
                            </ul>
                        </div>
                        <div class="col-sm-12">
                            <!-- <p>Compañía : <?php echo  $result->COMPANYNAME; ?></p> -->
                            <p>Compañía : </p>
                            <ul style="list-style: none;">
                                <li><?php echo $result->COMPANYNAME; ?></li>
                            </ul>
                            <!-- <p>Ubicación : <?php echo  $result->COMPANYADDRESS; ?></p> -->
                            <p>Ubicación de la Compañía : </p>
                            <ul style="list-style: none;">
                                <li><?php echo  "Ubigeo : " . $result->pais . ' - ' . $result->departamento . ' - ' . $result->provincia . ' - ' . $result->distrito; ?></li>
                                <li><?php echo  "Dirección : " . $result->COMPANYADDRESS; ?></li>
                            </ul>

                        </div>
                    </div>
                    <div class="col-sm-2"> <a href="<?php echo web_root; ?>index.php?q=apply&job=<?php echo $result->JOBID; ?>&view=personalinfo" class="btn btn-main btn-next-tab">Postula Ahora !</a></div>
                </div>
                <div class="panel-footer">
                    Fecha de Publicación : <?php echo date_format(date_create($result->DATEPOSTED), 'M d, Y'); ?>
                </div>
            </div>
        <?php  } ?>
    </div>
</section>