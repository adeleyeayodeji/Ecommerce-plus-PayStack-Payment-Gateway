<?php 
//CHeck valid file path
define('BASE_PATH', basename(__FILE__) );
//Process Authentication 
include 'inc/process.php';
//Check for active user in session
if (!isset($_SESSION['email'])) {
	//Do this if user is not active
	header('location: index.php'); //Redirect back to homepage if user is not active
}
//Including the header
 include 'inc/header.php';
 //Including the nav bar
 include 'inc/nav.php';
 ?>
<!-- ========================= SECTION PAGETOP ========================= -->
<section class="section-pagetop bg-gray">
<div class="container">
	<h2 class="title-page">Profile</h2>
</div> <!-- container //  -->
</section>
<!-- ========================= SECTION PAGETOP END// ========================= -->

<!-- ========================= SECTION CONTENT ========================= -->
<section class="section-content padding-y">
<div class="container">

<div class="row">
	<?php
		//Include user side bar
		include 'inc/sidebar.php';
	?>
	<main class="col-md-9">

	<div class="card">
      <div class="card-body">
		<?php
		//Display success log
			if (isset($msg)) {
				?>
					<div class="alert alert-success">
						<?php echo $msg; ?>		
					</div>
				<?php
			//Display error log
			}elseif(isset($error)){
				?>
					<div class="alert alert-danger">
						<?php echo $error; ?>		
					</div>
				<?php
			}
		?>
     <form class="row" action="" method="post">
     	<div class="col-md-9">
     		<div class="form-row">
				<div class="col form-group">
					<label>Name</label>
				  	<input type="text" name="fullname" class="form-control" value="<?php echo $_SESSION['fullname']; ?>">
				</div> <!-- form-group end.// -->
				<div class="col form-group">
					<label>Email</label>
				  	<input type="email" readonly name="email" class="form-control" value="<?php echo $_SESSION['email']; ?>">
				</div> <!-- form-group end.// -->
			</div> <!-- form-row.// -->

			<button class="btn btn-primary" name="updateadmin">Save</button>	
			<button class="btn btn-light" type="button" style="cursor: not-allowed;
background: lightgray;">Change password</button>	

			<br><br>

     	</div> <!-- col.// -->
	  </form>
	  <hr>
	  <!-- Update current slider images -->
		<div class="row">
			<div class="col">
				<form class="row" action="" method="post">
					<div class="col-md-9">
						<div class="form-row">
							<div class="col form-group">
								<label class="btn btn-dark">Slider One</label>
								<div class="img" id="getpic2" style="    background: url(images/banners/slide-lg-3.jpg);background-position: center top;background-size: cover;background-repeat: no-repeat;border: 3px solid black;">
									<div style="height: 204px;background: #000000ad;">
									<label>
										<p href="javascript:;" class="btn btn-primary" style="margin-top: 70px;margin-left: 110px;">Select Image</p>
										<input type="file" name="filename" style="display: none;" id="productimage" onchange="imagepreview(event, 'getpic2')">
									</label>
									</div>
								</div>
							</div> <!-- form-group end.// -->
						</div> <!-- form-row.// -->

						<button class="btn btn-primary" name="update_slider_1">Update Slider 1</button>		
					</div> <!-- col.// -->
				</form>
			</div>
			<div class="col">
				<form class="row" action="" method="post">
						<div class="col-md-9">
							<div class="form-row">
								<div class="col form-group">
									<label class="btn btn-dark">Slider Two</label>
									<div class="img" id="getpic3" style="    background: url(images/banners/slide-lg-2.jpg);background-position: center top;background-size: cover;background-repeat: no-repeat;border: 3px solid black;">
										<div style="height: 204px;background: #000000ad;">
										<label>
											<p href="javascript:;" class="btn btn-primary" style="margin-top: 70px;margin-left: 110px;">Select Image</p>
											<input type="file" name="filename" style="display: none;" id="productimage" onchange="imagepreview(event, 'getpic3')">
										</label>
										</div>
									</div>
								</div> <!-- form-group end.// -->
							</div> <!-- form-row.// -->

							<button class="btn btn-primary" name="update_slider_2">Update Slider 2</button>		
						</div> <!-- col.// -->
					</form>
			</div>
		</div>
      </div> <!-- card-body.// -->
    </div> <!-- card .// -->



	</main> <!-- col.// -->
</div>

</div> <!-- container .//  -->
</section>
<!-- ========================= SECTION CONTENT END// ========================= -->
<?php 
	//Including the footer
   include 'inc/footer.php';    
?>
