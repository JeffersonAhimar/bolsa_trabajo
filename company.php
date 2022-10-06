<?php
if (!isset($_SESSION['APPLICANTID'])) {
    # code...
    redirect(web_root . 'index.php');
}
?>
<section id="content">
    <div class="container content">
        <div class="row">
            <?php
            // $sql = "SELECT * FROM `tblcompany`";
            $sql = "SELECT * FROM tblcompany c";
            $sql .= " INNER JOIN tblpais pa ON pa.idPais=c.COMPANYPAIS";
            $sql .= " INNER JOIN tbldepartamentos d ON d.idDepartamento=c.COMPANYDEPARTAMENTO";
            $sql .= " INNER JOIN tblprovincia pro ON pro.idProvincia=c.COMPANYPROVINCIA";
            $sql .= " INNER JOIN tbldistrito dis ON dis.idDistrito=c.COMPANYDISTRITO";
            // $sql .= " LIMIT 9";

            $mydb->setQuery($sql);
            $comp = $mydb->loadResultList();

            foreach ($comp as $company) {
            ?>
                <div class="col-sm-3 info-blocks col-sm-offset-1" style="margin-bottom: 30px;">
                    <?php
                    if ($company->COMPANYPHOTO == '') {
                        echo '<i class="icon-info-blocks fa fa-building-o"></i>';
                    } else {
                        echo '<img src="' . web_root . 'uploads/images/companies/' . $company->COMPANYPHOTO . '" alt="" height="100px">';
                    }
                    ?>
                    <div class="info-blocks-in">
                        <h3><?php echo '<a href="' . web_root . 'index.php?q=hiring&search=' . $company->COMPANYNAME . '">' . $company->COMPANYNAME . '</a>'; ?></h3>
                        <p style="font-size: 12px;"><?php echo $company->pais . '-' . $company->departamento; ?></p>
                        <p style="font-size: 12px;"><?php echo $company->provincia . '-' . $company->distrito; ?></p>
                        <p style="font-size: 13px;"><?php echo $company->COMPANYADDRESS; ?></p>
                        <p style="font-size: 13px;">Tlf: <?php echo $company->COMPANYCONTACTNO; ?></p>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</section>