<section id="content">
    <div class="container content">

        <?php
        if (isset($_GET['search'])) {
            # code...
            $jobid = $_GET['search'];
        } else {
            $jobid = '';
        }
        $sql = "SELECT * FROM `tblcompany` c,`tbljob` j WHERE c.`COMPANYID`=j.`COMPANYID` AND JOBID LIKE '%" . $jobid . "%' ORDER BY DATEPOSTED DESC";
        $mydb->setQuery($sql);
        $cur = $mydb->loadResultList();


        foreach ($cur as $result) {
            # code...

            // `OCCUPATIONTITLE`, `REQ_NO_EMPLOYEES`, `SALARIES`, `DURATION_EMPLOYEMENT`, `QUALIFICATION_WORKEXPERIENCE`, `PREFEREDSEX`, `DATEPOSTED`
        ?>
            <div class="container">
                <div class="mg-available-rooms">
                    <h5 class="mg-sec-left-title">Fecha de Publicación : <?php echo date_format(date_create($result->DATEPOSTED), 'M d, Y'); ?></h5>
                    <div class="mg-avl-rooms">
                        <div class="mg-avl-room">
                            <div class="row">
                                <div class="col-sm-2">
                                    <!-- <a href="#"><span class="fa fa-building-o" style="font-size: 50px"></span> -->
                                    <!-- <img src="img/room-1.png" alt="" class="img-responsive"></a> -->
                                    <?php
                                    // if ($result->COMPANYPHOTO == '') {
                                    //     echo '<span class="fa fa-building-o" style="font-size: 50px"></span>';
                                    //     // echo web_root . 'uploads/images/no-image.png';
                                    // } else {
                                    //     echo '<img src="' . web_root . 'company/user/' . $result->COMPANYPHOTO . '" alt="" width="80px" height="100%">';
                                    // }
                                    if ($result->COMPANYPHOTO == '') {
                                        echo '<i class="icon-info-blocks fa fa-building-o" style="font-size: 100px"></i>';
                                    } else {
                                        echo '<img src="' . web_root . 'uploads/images/companies/' . $result->COMPANYPHOTO . '" alt="" height="100px">';
                                    }
                                    ?>
                                </div>
                                <div class="col-sm-10">
                                    <div style="border-bottom: 1px solid #ddd;padding: 10px;font-size: 25px;font-weight: bold;color: #000;margin-bottom: 5px;"><?php echo $result->OCCUPATIONTITLE; ?>
                                    </div>
                                    <div class="row contentbody">
                                        <div class="col-sm-6">
                                            <ul>
                                                <li><i class="fp-ht-bed"></i>Vacantes : <?php echo $result->REQ_NO_EMPLOYEES; ?></li>
                                                <li><i class="fp-ht-food"></i>Salario : <?php echo ' S/ ' . number_format($result->SALARIES, 2);  ?></li>
                                                <li><i class="fa fa-sun-"></i>Duración del Empleo : <?php echo $result->DURATION_EMPLOYEMENT; ?></li>
                                            </ul>
                                        </div>
                                        <div class="col-sm-6">
                                            <ul>
                                                <!-- <li><i class="fp-ht-dumbbell"></i>Qualification/Work Experience : <?php echo $result->QUALIFICATION_WORKEXPERIENCE; ?></li> -->
                                                <li><i class="fp-ht-tv"></i>Modalidad : <?php echo $result->JOBTYPE; ?></li>
                                            </ul>
                                        </div>
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
                                            <p>Ubicación : </p>
                                            <ul style="list-style: none;">
                                                <li><?php echo  $result->COMPANYDEPARTAMENTO . ' - ' . $result->COMPANYPROVINCIA . ' - ' . $result->COMPANYDISTRITO; ?></li>
                                                <li><?php echo  $result->COMPANYADDRESS; ?></li>
                                            </ul>

                                        </div>
                                    </div>
                                    <a href="<?php echo web_root; ?>index.php?q=apply&job=<?php echo $result->JOBID; ?>&view=personalinfo" class="btn btn-main btn-next-tab">Postula Ahora !</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        <?php  } ?>
    </div>
</section>