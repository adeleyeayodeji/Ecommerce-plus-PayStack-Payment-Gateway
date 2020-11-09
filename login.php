<?php
    //Process Authentication 
	include 'inc/process.php';
	//Including the header
	include 'inc/header.php';
	//Including the nav bar
	include 'inc/nav.php';

?>
<!-- ========================= SECTION CONTENT ========================= -->
<section class="section-conten padding-y" style="min-height:84vh">

<!-- ============================ COMPONENT LOGIN   ================================= -->
	<div class="card mx-auto p-2" style="max-width: 380px; margin-top:100px;">
      <div class="card-body">
      <h4 class="card-title text-center mb-4">Sign in</h4>
        <?php
            //Display warning if user not found
            if (isset($msg)) {
                ?>
                      <div class="alert alert-warning text-center">
                            <?php echo $msg; ?>
                    </div>
                <?php
            }
        ?>
      <form method="post" action="">
          <div class="form-group">
			 <input name="email" class="form-control" placeholder="Email" type="email">
          </div> <!-- form-group// -->
          <div class="form-group">
			<input name="password" class="form-control" placeholder="Password" type="password">
          </div> <!-- form-group// -->
          <!-- form-group form-check .// -->
          <div class="form-group">
              <button type="submit" name="login" class="btn btn-primary btn-block"> Login  </button>
          </div> <!-- form-group// -->    
      </form>
      </div> <!-- card-body.// -->
    </div> <!-- card .// -->
<!-- ============================ COMPONENT LOGIN  END.// ================================= -->


</section>
<!-- ========================= SECTION CONTENT END// ========================= -->

<?php
	include 'inc/footer.php';
?>