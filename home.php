  <section id="banner">

    <!-- Slider -->
    <div id="main-slider" class="flexslider">
      <ul class="slides">
        <li>
          <img src="<?php echo web_root; ?>plugins/home-plugins/img/slides/1.jpg" alt="" />
          <div class="flex-caption">
            <!-- <h3>innovation</h3> -->
            <!-- <p>We create the opportunities</p> -->

          </div>
        </li>
        <li>
          <img src="<?php echo web_root; ?>plugins/home-plugins/img/slides/2.jpg" alt="" />
          <div class="flex-caption">
            <!-- <h3>Specialize</h3> -->
            <!-- <p>Success depends on work</p> -->

          </div>
        </li>
      </ul>
    </div>
    <!-- end slider -->

  </section>


  <section id="content">


    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="aligncenter">
            <h2 class="aligncenter">Compañías</h2><!-- Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolores quae porro consequatur aliquam, incidunt eius magni provident, doloribus omnis minus ovident, doloribus omnis minus temporibus perferendis nesciunt.. -->
          </div>
          <br />
        </div>
      </div>

      <?php
      $sql = "SELECT * FROM `tblcompany`";
      $mydb->setQuery($sql);
      $comp = $mydb->loadResultList();


      foreach ($comp as $company) {
        # code...

      ?>
        <div class="col-sm-4 info-blocks">
          <i class="icon-info-blocks fa fa-building-o"></i>
          <div class="info-blocks-in">
            <h3><?php echo $company->COMPANYNAME; ?></h3>
            <!-- <p><?php echo $company->COMPANYMISSION; ?></p> -->
            <p>Dirección: <?php echo $company->COMPANYADDRESS; ?></p>
            <p>Nro. de Contacto: <?php echo $company->COMPANYCONTACTNO; ?></p>
          </div>
        </div>

      <?php } ?>
    </div>
  </section>

  <div class="about home-about">
    <div class="container">

      <div class="row">
        <br>

      </div>

    </div>