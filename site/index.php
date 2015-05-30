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
    <div class="container">
      <!-- Header -->
      <div class="row">
        <div class="col-md-12">
          <div class="text-center">
            <div class="site-title"><?php echo $siteTitle; ?></div>
            <div class="site-tagline"><?php echo $siteTagline; ?></div>
          </div>
        </div>
      </div><!-- /Header -->
      <div class="row">
        <?php include 'inc/navigation.php'; ?>
      </div>
      <!-- Content -->
      <div class="row">
        <!-- Top Donors -->
        <div class="col-md-3">
          <div class="top-donors">
            <h1>Top Donors</h1>
            <div class="row">
              <div class="col-md-12">
                <div class="table-responsive">
                <table class="table-hover" width="100%">
                  <tr>
                    <th>#</th>
                    <th>Nickname</th>
                    <th>Donated</th>
                  </tr>
                  <?php
                    for ($i=0; $i<10; $i++){
                  ?>
                  <tr>
                    <td>1</td>
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
        <div class="col-md-9">
          <div class="visible-md-block">
          <!-- Store Map -->
          <div class="store-map">
            <h1>Participating Stores</h1>
            <h2>See all the stores that support the project.</h2>
            <iframe
              src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d12579.075981496286!2d23.729811126253562!3d37.98252000048911!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2s!4v1432987195384"
              width="100%"
              height="100%"
              frameborder="0"
              style="border:0">
            </iframe>
          </div><!-- /Store Map -->
        </div>
        </div><!-- /Main Form -->
      </div><!-- /Content -->
      <!-- Footer -->

        <?php include 'inc/footer.php' ?>
      </div><!-- /Footer -->
    </div><!-- /Container -->
    <?php require_once 'inc/scripts.php'; ?>
  </body>
</html>
