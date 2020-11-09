<?php 
//CHeck valid file path
define('BASE_PATH', basename(__FILE__) );
//Process Authentication 
include 'inc/cart_process.php';
//Load product data
if (isset($_GET['pid'])) {
    //Get product id
    $pid = $_GET['pid'];
    //Return product details from base
    //SQL
    $sql = "SELECT * FROM products WHERE id = '$pid'";
    //Query
    $query = mysqli_query($db_con, $sql) or die('Cant connect to base');
    //Fetch product data
    $result = mysqli_fetch_assoc($query);
    //log
    // echo var_dump($result);
}
//Check for active user in session
// if (!isset($_SESSION['email'])) { //Allow guest purchase
// 	//Do this if user is not active
// 	header('location: index.php'); //Redirect back to homepage if user is not active
// }
//Including the header
 include 'inc/header.php';
 //Including the nav bar
 include 'inc/nav.php';
 ?>
<section class="py-3 bg-light">
  <div class="container">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
        <li class="breadcrumb-item"><a href="#"><?php echo ShowCategory($result['category']); ?></a></li>
        <li class="breadcrumb-item active" aria-current="page"><?php echo $result['title']; ?></li>
    </ol>
  </div>
</section>

<!-- ========================= SECTION CONTENT ========================= -->
<section class="section-content bg-white padding-y">
<div class="container">

<!-- ============================ ITEM DETAIL ======================== -->
	<div class="row">
		<aside class="col-md-6">
      <div class="card">
        <article class="gallery-wrap"> 
          <div class="img-big-wrap">
            <div> <a href="javascript:;"><img src="images/uploads/<?php echo $result['product_image']; ?>"></a></div>
          </div> <!-- slider-product.// -->
          <div class="thumbs-wrap">
            <a href="javascript:;" class="item-thumb"> <img src="images/uploads/<?php echo $result['product_image']; ?>"></a>
          </div> <!-- slider-nav.// -->
        </article> <!-- gallery-wrap .end// -->
      </div> <!-- card.// -->
		</aside>
		<main class="col-md-6">
<article class="product-info-aside">
<?php
  include 'inc/notify.php';
?>
<h2 class="title mt-3"><?php echo $result['title']; ?></h2>

<div class="rating-wrap my-3">
	<ul class="rating-stars">
		<li style="width:80%" class="stars-active"> 
			<i class="fa fa-star"></i> <i class="fa fa-star"></i> 
			<i class="fa fa-star"></i> 
		</li>
		<li>
			<i class="fa fa-star"></i> <i class="fa fa-star"></i> 
			<i class="fa fa-star"></i> <i class="fa fa-star"></i> 
			<i class="fa fa-star"></i> 
		</li>
	</ul>
	<small class="label-rating text-muted">2 reviews</small>
</div> <!-- rating-wrap.// -->

<div class="mb-3"> 
	<var class="price h4">NG <?php echo number_format($result['price']); ?></var> 
</div> <!-- price-detail-wrap .// -->

	 <div class="content">
    <?php echo html_entity_decode($result['description']); ?>
   </div>

	<div class="form-row  mt-4">
    <form action="" method="post">
      <div class="form-group col-md flex-grow-0">
        <div class="input-group mb-3 input-spinner">
          <div class="input-group-prepend">
            <button class="btn btn-light" type="button" onclick="button_minus()"> &minus; </button>
          </div>
          <input type="text" id="addmore" name="quantity" class="form-control" value="1">
          <!-- Product id to be added to cart -->
          <input type="hidden" name="pid" value="<?php echo $pid; ?>">
          <!-- Product id to be added to cart ends here -->
          <div class="input-group-append">
            <button class="btn btn-light" type="button" onclick="button_plus()"> + </button>
          </div>
        </div>
      </div> <!-- col.// -->
      <div class="form-group col-md">
        <button type="submit" name="addtocart" class="btn  btn-primary"> 
          <i class="fas fa-shopping-cart"></i> <span class="text">Add to cart</span> 
        </button>
      </div> <!-- col.// -->
    </form>
	</div> <!-- row.// -->

</article> <!-- product-info-aside .// -->
		</main> <!-- col.// -->
	</div> <!-- row.// -->

<!-- ================ ITEM DETAIL END .// ================= -->


</div> <!-- container .//  -->
</section>
<!-- ========================= SECTION CONTENT END// ========================= -->
<?php
	include 'inc/footer.php';
?>
<script>
  //Adding 1 to current value
  var new_value = 1;
  //Button plus
  function button_plus(){
    //Getting the current value from the input field storing into value var
    var value = document.getElementById("addmore");
    //Run in new value
    var better = parseInt(value.value) + new_value;
    //Load data into value
    value.value = new_value;
    //Log 
    // console.log(better);
    //Loop through
    new_value++;
  }

  //Button minus
  function button_minus(){
    //Getting the current value from the input field storing into value var
    var value = document.getElementById("addmore");
    //Reducing minus -1
    var better = parseInt(value.value) - 1;
    //Load data into value
    value.value = better;
    //Log
    // console.log(better);
  }
</script>