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
                    <!-- <i class="icon-info-blocks fa fa-building-o"></i> -->

                    <i class="fa">
                        <img src="
            <?php
                if ($company->COMPANYPHOTO == '') {
                    echo web_root . 'uploads/images/no-image.png';
                } else {
                    echo web_root . 'company/user/' . $company->COMPANYPHOTO;
                }
            ?>
            " alt="" width="80px" height="100%">
                    </i>
                    <div class="info-blocks-in">
                        <h3><?php echo '<a href="' . web_root . 'index.php?q=hiring&search=' . $company->COMPANYNAME . '">' . $company->COMPANYNAME . '</a>'; ?></h3>
                        <!-- <p><?php echo $company->COMPANYMISSION; ?></p> -->
                        <p>Dirección :<?php echo $company->COMPANYADDRESS; ?></p>
                        <p>Nro. de Contacto :<?php echo $company->COMPANYCONTACTNO; ?></p>
                    </div>
                </div>

            <?php } ?>



        </div>
    </div>
</section>