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
    <h1 class="text-center"><?php echo $siteTitle; ?></h1>
    <h3 class="text-center">Login:</h3>
  <div class="container">
    <div class="row">
      <div class="col-md-4 col-md-offset-4">
    <form>
        <div class="form-group">
              <label for="exampleInputEmail1">Email address</label>
              <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
          </div>
            <div class="form-group">
              <label for="exampleInputPassword1">Password</label>
              <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
          </div>
          <div class="form-group">
             <div class="checkbox">
                 <label>
                   <input type="checkbox"> Remember me
                 </label>
               </div>
           </div>
           <div class="form-group">
               <button type="submit" class="btn btn-primary btn-lg">Sign in</button>
            </div>
</form>
</div>
</div>
</div>  
        <?php include "inc/footer.php"?>
    </div><!-- /Container -->
    <?php require_once 'inc/scripts.php'; ?>
    </body>
    </html>
