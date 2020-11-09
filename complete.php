<?php 
//CHeck valid file path
define('BASE_PATH', basename(__FILE__) );
//Process Authentication 
include 'inc/cart_process.php';
//Load product data
//Including the header
 include 'inc/header.php';
 //Including the nav bar
 include 'inc/nav.php';
 ?>
<!-- ========================= SECTION CONTENT ========================= -->
<section class="section-content padding-y">
<div class="container">

<div class="row">
	<aside class="col">
		<div class="card">
			<div class="card-body">
					<div class="alert alert-success text-center">
                        <strong>Transaction Completed</strong>
                    </div>
					<hr>
					<div class="text-center">
						<a href="index.php" class="btn btn-primary" id="purchasebtn"> Continue Shopping <i class="fa fa-chevron-right"></i> </a>
					</div>
			</div> <!-- card-body.// -->
		</div>  <!-- card .// -->
	</aside> <!-- col.// -->
</div>

</div> <!-- container .//  -->
</section>
<!-- ========================= SECTION CONTENT END// ========================= -->
<?php
    include 'inc/footer.php';
?>