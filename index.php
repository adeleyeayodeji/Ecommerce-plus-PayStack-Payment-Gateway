<?php 
//Process Authentication 
include 'inc/process.php';
//Including the header
 include 'inc/header.php';
 //Including the nav bar
 include 'inc/nav.php';
 ?>
<!-- ========================= SECTION MAIN  ========================= -->
<section class="section-intro padding-y">
<div class="container">
<!-- ==============  COMPONENT SLIDER  BOOTSTRAP ============  -->
<?php
	//Load the slider image from the database
	

?>
<div id="carousel1_indicator" class="slider-home-banner carousel slide" data-ride="carousel">
  <ol class="carousel-indicators">
    <li data-target="#carousel1_indicator" data-slide-to="0" class="active"></li>
    <li data-target="#carousel1_indicator" data-slide-to="1"></li>
  </ol>
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="images/banners/slide-lg-3.jpg" alt="First slide"> 
    </div>
    <div class="carousel-item">
      <img src="images/banners/slide-lg-2.jpg" alt="Second slide">
    </div>
  </div>
  <a class="carousel-control-prev" href="#carousel1_indicator" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carousel1_indicator" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div> 
<!-- ============ COMPONENT SLIDER BOOTSTRAP end.// ===========  .// -->	
	
</div> <!-- container end.// -->
</section>
<!-- ========================= SECTION MAIN END// ========================= -->


<div class="container">

<!-- =============== SECTION 1 =============== -->
<section class="padding-bottom">
<header class="section-heading mb-4">
	<h3 class="title-section">Recommended items</h3>
</header>

<div class="row">
	<?php
		//Looping all products in database
		//SQL
		$sql = "SELECT * FROM products ORDER BY id DESC";
		//QUERY
		$query = mysqli_query($db_con, $sql) or die('Cant fetch data');
		//Return all result in an array
		while ($result = mysqli_fetch_assoc($query)) {
			//Now loop through data
			?>	
			<div class="col-xl-3 col-lg-3 col-md-4 col-6">
				<div class="card card-product-grid">
					<a href="product.php?pid=<?php echo $result['id']; ?>" class="img-wrap"> <img src="images/uploads/<?php echo $result['product_image']; ?>"> </a>
					<figcaption class="info-wrap">
						<ul class="rating-stars mb-1">
							<li style="width:80%" class="stars-active">
								<img src="images/icons/stars-active.svg" alt="">
							</li>
							<li>
								<img src="images/icons/starts-disable.svg" alt="">
							</li>
						</ul>
						<div>
							<a href="#" class="text-muted"><?php echo ShowCategory($result['category']); ?></a>
							<a href="#" class="title"><?php echo $result['title']; ?></a>
						</div>
						<div class="price h5 mt-2">₦<?php echo number_format($result['price']); ?></div> <!-- price.// -->
					</figcaption>
				</div>
			</div> <!-- col.// -->
			<?php
		}
	?>
</div> <!-- row.// -->
</section>
<!-- =============== SECTION 1 END =============== -->

</div>  
<!-- container end.// -->

<?php 
	//Including the footer
   include 'inc/footer.php';    
?>