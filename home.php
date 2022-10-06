<!-- Slider -->
<div id="main-slider" class="flexslider">
  <ul class="slides">
    <li>
      <img src="<?php echo web_root; ?>plugins/home-plugins/img/slides/1.jpg" alt="" />
      <div class="flex-caption">


      </div>
    </li>
    <li>
      <img src="<?php echo web_root; ?>plugins/home-plugins/img/slides/2.jpg" alt="" />
      <div class="flex-caption">


      </div>
    </li>
  </ul>
</div>
<!-- end slider -->

</section>


<section id="content">


  <div class="container">


    <!-- INICIO ROW -->
    <div class="row">
      <div class="col-md-12">
        <div class="aligncenter">
          <h2 class="aligncenter">Compañías</h2>En este espacio se podrá acceder a ofertas laborales publicadas por las empresas que requieran personal.
        </div>
        <br />
      </div>
    </div>
    <!-- END ROW -->
    <?php
    $sql = "SELECT * FROM tblcompany c";
    $sql .= " INNER JOIN tblpais pa ON pa.idPais=c.COMPANYPAIS";
    $sql .= " INNER JOIN tbldepartamentos d ON d.idDepartamento=c.COMPANYDEPARTAMENTO";
    $sql .= " INNER JOIN tblprovincia pro ON pro.idProvincia=c.COMPANYPROVINCIA";
    $sql .= " INNER JOIN tbldistrito dis ON dis.idDistrito=c.COMPANYDISTRITO";
    $sql .= " LIMIT 6";
    $mydb->setQuery($sql);
    $comp = $mydb->loadResultList();
    ?>



    <?php
    foreach ($comp as $company) {
    ?>

      <div class="col-sm-3 info-blocks col-sm-offset-1" style="margin-bottom: 30px;">
        <?php
        if ($company->COMPANYPHOTO == '') {
          echo '<i class="icon-info-blocks fa fa-building-o"></i>';
        } else {
          echo '<img src="' . web_root . 'uploads/images/companies/' . $company->COMPANYPHOTO . '" alt="">';
        }
        ?>
        <div class="info-blocks-in">
          <h3><?php echo $company->COMPANYNAME; ?></h3>
          <p style="font-size: 12px;"><?php echo $company->pais . '-' . $company->departamento; ?></p>
          <p style="font-size: 12px;"><?php echo $company->provincia . '-' . $company->distrito; ?></p>
          <p style="font-size: 13px;"> <?php echo $company->COMPANYADDRESS; ?></p>
          <p style="font-size: 13px;">Tlf: <?php echo $company->COMPANYCONTACTNO; ?></p>
        </div>
      </div>

    <?php
    }
    ?>




  </div>
</section>

<div class="about home-about">
  <div class="container">

    <div class="row">
      <br>

    </div>

  </div>
</div>