<?php
if (!isset($_SESSION['APPLICANTID'])) {
    # code...
    redirect(web_root . 'index.php');
}
?>
<section id="content">
    <div class="container content">
        <!-- Service Blcoks -->

        <!--     <div class="row"> 
        <div class="col-md-12">
            <div class="about-logo">
                <h3><span class="color">Hirring Now</span></h3>
                <p>Sed ut perspiciaatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas</p>
                    <p>Sed ut perspiciaatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas</p>
            </div>  
        </div>
    </div>
      -->

        <?php
        if (isset($_GET['search'])) {
            # code...
            $category = $_GET['search'];
        } else {
            $category = '';
        }
        $sql = "SELECT * FROM `tblcompany` c,`tbljob` j WHERE c.`COMPANYID`=j.`COMPANYID` AND CATEGORY LIKE '%" . $category . "%' ORDER BY DATEPOSTED DESC";
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
                            <p>Compañía : <?php echo  $result->COMPANYNAME ?></p>
                            <p>Ubicación : <?php echo  $result->COMPANYADDRESS ?></p>
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