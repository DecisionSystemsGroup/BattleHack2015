<?php
  session_start();
  require_once 'inc/configuration.php';
?>
<!DOCTYPE html>
<html lang = "en">
  <head>
    <?php require_once 'inc/head.php'; ?>
  </head>

  <body>
    <?php #include 'inc/navigation.php'; ?>
    <div class="container">
      <!-- Content -->
      <div class="site-title">
        <h1>Food<span>4</span>Charity</h1>
        <h2><i>Pay the meal for the people that need it most.</i></h2>
      </div>
      <div class="row">
        <div class="col-md-10 col-md-offset-1 text-center">
          <h1>Say no to hunger!</h1>
          <h2>Provide a meal to someone that cannot pay for it.</h2>
          <h3> Just choose your desired meal and quantity, pay with your paypal or credit card and make someone happy.</h3>
        </div>
      </div>
      <div class="header-stores">
      <div class="row">
        <h4 class="text-center">Choose from:</h4>
        <div class="text-center col-xs-2 col-xs-offset-1 ">
          <a href="#" onclick="storeEntered()">
            <img src="img/MITSOS.png" class="img-rounded img-responsive"/>
            <span class="store-title">Γυράδικο "Ο Μήτσος"</span>
          </a>
        </div>
        <div class="text-center col-xs-2">
          <img src="img/MITSOS.png" class="img-rounded img-responsive"/>
          <span class="store-title">Γυράδικο "Ο Μήτσος"</span>
        </div>
        <div class="text-center col-xs-2">
          <img src="img/MITSOS.png" class="img-rounded img-responsive"/>
          <span class="store-title">Γυράδικο "Ο Μήτσος"</span>
        </div>
        <div class="text-center col-xs-2">
          <img src="img/MITSOS.png" class="img-rounded img-responsive"/>
          <span class="store-title">Γυράδικο "Ο Μήτσος"</span>
        </div>
        <div class="text-center col-xs-2">
          <img src="img/MITSOS.png" class="img-rounded img-responsive"/>
          <span class="store-title">Γυράδικο "Ο Μήτσος"</span>
        </div>
      </div>
      </div>
      <div class="row" id="primary">
        <!-- Top Donors -->
        <div class="col-md-3">
          <div class="top-donors">
            <h1 class="text-center">Top Donors</h1>
            <div class="row">
              <div class="col-md-12">
                <div class="table-responsive">
                <table class="table-striped" width="100%">
                  <tr>
                    <th>#</th>
                    <th>Nickname</th>
                    <th>Donated</th>
                  </tr>
                  <?php
                    for ($i=0; $i<10; $i++){
                  ?>
                  <tr>
                    <td><?php echo $i+1;  ?></td>
                    <td>Pandorian</td>
                    <td>N/A</td>
                  </tr>
                  <?php
                    }
                  ?>
                </table>
              </div>
              </div>
            </div>
          </div>
        </div><!-- /Top Donors -->
        <!-- Main Form -->
        <div class="col-md-9 visible-md-9 hidden-xs hidden-sm">
          <!-- Store Map -->
          <div class="main-content">
            <h1>Participating Stores</h1>
            <h2>See all the stores that support the project.</h2>
            <?php include 'inc/gmap.php'; ?>
          </div><!-- /Store Map -->
        </div><!-- /Main Form -->
      </div><!-- /Content -->
      <!-- Footer -->

        <?php include 'inc/footer.php' ?>
      </div><!-- /Footer -->
    </div><!-- /Container -->
    <?php require_once 'inc/scripts.php'; ?>
  </body>
</html>
