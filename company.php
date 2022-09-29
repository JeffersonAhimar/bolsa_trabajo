<?php
if (!isset($_SESSION['APPLICANTID'])) {
    # code...
    redirect(web_root . 'index.php');
}
?>
<section id="content">
    <div class="container content">
        <!-- Service Blcoks -->
        <div class="row">
            <?php
            $sql = "SELECT * FROM `tblcompany`";
            $mydb->setQuery($sql);
            $comp = $mydb->loadResultList();

            foreach ($comp as $company) {
            ?>
                <div class="col-sm-4 info-blocks">
                    <?php
                    if ($company->COMPANYPHOTO == '') {
                        echo '<i class="icon-info-blocks fa fa-building-o"></i>';
                    } else {
                        echo '<img src="' . web_root . 'uploads/images/companies/' . $company->COMPANYPHOTO . '" alt="" height="100px">';
                    }
                    ?>

                    <div class="info-blocks-in">
                        <h3><?php echo '<a href="' . web_root . 'index.php?q=hiring&search=' . $company->COMPANYNAME . '">' . $company->COMPANYNAME . '</a>'; ?></h3>
                        <!-- <p><?php echo $company->COMPANYMISSION; ?></p> -->
                        <p>Dirección : <?php echo $company->COMPANYADDRESS; ?></p>
                        <p>Nro. de Contacto : <?php echo $company->COMPANYCONTACTNO; ?></p>
                    </div>
                </div>

            <?php } ?>



        </div>
    </div>
</section>