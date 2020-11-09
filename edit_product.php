<?php 
//CHeck valid file path
define('BASE_PATH', basename(__FILE__) );
//Process Authentication 
include 'inc/process.php';

//Get Product ID
if (isset($_GET['id'])) {
    //Get Product ID
    $product_id = $_GET['id'];
    //SQL
    $sql = "SELECT * FROM products WHERE id = '$product_id'";
    //Query
    $query = mysqli_query($db_con, $sql);
    //Return result in $result 
    $result = mysqli_fetch_assoc($query);
}else{
    //If id not found redirect to all products
    header("location: products.php");
}

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
	<h2 class="title-page">Edit Product</h2>
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
		<article class="card mb-4">
		<header class="card-header">
			<a href="products.php" class="float-right btn btn-outline-secondary"> <i class="fa fa-arrow-back"></i> All Product</a>
			<strong class="d-inline-block mr-3">Edit Product </strong>
        </header>
        <br>
		<div class="table-responsive p-3 bg-gray">
			<form action="" method="post" class="formhome" enctype="multipart/form-data">
                <?php
                    //Include notification bar
					include 'inc/notify.php';
				?>
				<div class="form-group">
					<label for="title">Product Title</label>
					<input type="text" name="title" class="form-control" value="<?php echo $result['title']; ?>" placeholder="Enter product title" id="">
				</div>
				<div class="row">
					<div class="col-8">
						<div class="form-group">
							<label for="description" class="btn btn-dark">Product Description</label>
							<textarea name="description" class="form-control" placeholder="Enter product drescription" style="height: 408px;"><?php echo $result['description']; ?></textarea>
						</div>
                    </div>
                    <!-- Define old product image -->
                    <input type="hidden" name="old_product_image" value="<?php echo $result['product_image']; ?>">
					<!-- Old product image definition end -->
					
					<!-- Get current product id  -->
					<input type="hidden" name="pid" value="<?php echo $result['id']; ?>">
					<!-- Get product end here -->
					<div class="col-4">
						<div class="form-group">
							<label for="image" class="btn btn-dark">Product Image</label>
							<div class="img" id="getpic" style="    background: url(images/uploads/<?php echo $result['product_image']; ?>);background-position: center top;background-size: cover;background-repeat: no-repeat;border: 3px solid black;">
									<div style="height: 204px;background: #000000ad;">
									<label>
										<p href="javascript:;" class="btn btn-primary" style="margin-top: 70px;margin-left: 90px;">Select Image</p>
										<input type="file" name="filename" style="display: none;" id="productimage" onchange="imagepreview(event)">
									</label>
									</div>
							</div>
						</div>
						<div class="form-group">
							<label for="price" class="btn btn-dark">Product Price</label>
							<input type="number" value="<?php echo $result['price']; ?>" name="price" class="form-control" placeholder="Enter amount with out ₦" id="">
						</div>
						<div class="form-group">
							<label for="Product Category" class="btn btn-dark">Product Category</label>
							<select name="category" class="form-control" id="">
                                <?php
                                    //Display the current category
                                    ?>
                                    <option value="<?php echo $result['category']; ?>">
                                         <?php echo ShowCategory($result['category']); ?>
                                    </option>
                                    <!-- //Display the current category ends here -->
                                    <option value="0">=====================</option>
                                    <!-- Seperator -->
                                    <?php
									//SQL
									 $sql = "SELECT * FROM category";
									 //Run the query
									 $query = mysqli_query($db_con, $sql);
									 //Return the result selected
									 while ($result = mysqli_fetch_assoc($query)) {
										 ?>
											<option value="<?php echo $result['id']; ?>"><?php echo $result['name']; ?></option>
										 <?php
									 }
									
								?>
							</select>
						</div>
					</div>
					<div class="col">
						<div class="form-group">
							<input type="submit" name="edit_product" value="Update Product" class="form-control bg-primary text-white">
						</div>
					</div>
				</div>
            </form>
		</div> <!-- table-responsive .end// -->
		</article> <!-- card order-item .// -->
	</main> <!-- col.// -->
</div>

</div> <!-- container .//  -->
</section>
<!-- ========================= SECTION CONTENT END// ========================= -->

<?php
	include 'inc/footer.php';
?>
