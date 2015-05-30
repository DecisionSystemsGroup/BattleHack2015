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
    <?php include 'inc/navigation.php'; ?>
    <div class="container">
      <!-- Content -->
      <div class="row">
        <!-- Top Donors -->
        <div class="col-md-3">
          <div class="top-donors">
            <h1 class="text-center">Top Donors</h1>
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
          <div class="store-map">
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
