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
	<h2 class="title-page">My account</h2>
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

		<article class="card mb-3">
			<div class="card-body">
				
				<figure class="icontext">
						<div class="text">
							<!-- Retrieve data from session fullname -->
							<strong> <?php echo $_SESSION['fullname']; ?> </strong> <br> 
							<!-- Retrieve data from session email -->
							<p class="mb-2"> <?php echo $_SESSION['email']; ?>  </p> 
							<a href="profile.php" class="btn btn-light btn-sm">Edit</a>
						</div>
				</figure>
				<hr>
				<?php 
					//Get and count all orders
					//SQL for all orders
					$sql = "SELECT * FROM orders";
					//Query
					$query = mysqli_query($db_con, $sql);
					//Return into $all_orders as count
					$all_orders = mysqli_num_rows($query);

					//Get all products
					//SQL for all products
					$p_sql = "SELECT * FROM products";
					//Query
					$p_query = mysqli_query($db_con, $p_sql);
					//Return into $all_orders as count
					$all_products = mysqli_num_rows($p_query);

					//Get all category
					//SQL for all products
					$categroy_sql = "SELECT * FROM category";
					//Query
					$categroy_query = mysqli_query($db_con, $categroy_sql);
					//Return into $all_orders as count
					$all_categroy = mysqli_num_rows($categroy_query);
				?>
				<article class="card-group card-stat">
					<figure class="card bg">
						<div class="p-3">
							 <h4 class="title"><?php echo $all_orders; ?></h4>
							<span>New Orders</span>
						</div>
					</figure>
					<figure class="card bg">
						<div class="p-3">
							 <h4 class="title"><?php echo $all_products; ?></h4>
							<span>Products</span>
						</div>
					</figure>
					<figure class="card bg">
						<div class="p-3">
							 <h4 class="title"><?php echo $all_categroy; ?></h4>
							<span>Category</span>
						</div>
					</figure>
				</article>
				

			</div> <!-- card-body .// -->
		</article> <!-- card.// -->

		<article class="card  mb-3">
			<div class="card-body">
				<h5 class="card-title mb-4">Recent orders </h5>	

				<div class="row">
				<?php
				//loop through oreders from database
				//SQL
				$sql = "SELECT * FROM orders ORDER BY pid DESC LIMIT 3";
				//QUery
				$query = mysqli_query($db_con, $sql) or die("Cant fetch from database");
				//Now let through the data
				while ($result = mysqli_fetch_assoc($query)) {
					//Get the product details from products
					$pid = $result['pid'];
					//Fetching from product table
					//SQL
					$p_sql = "SELECT * FROM products WHERE id = '$pid'";
					//Query
					$p_query = mysqli_query($db_con, $p_sql) or die("Cant fetch product");
					//Return result into p_result
					$p_result = mysqli_fetch_assoc($p_query);
					//Now let dump in the data
					?>
					<div class="col-md-6">
						<figure class="itemside  mb-3">
							<div class="aside"><img src="images/uploads/<?php echo $p_result['product_image']; ?>" class="border img-sm"></div>
							<figcaption class="info">
								<time class="text-muted"><i class="fa fa-user"></i> <?php echo $result['customer_name']; ?></time>
								<p><?php echo $result['customer_email']; ?> </p>
								<span class="text-success">Order completed </span>
							</figcaption>
						</figure>
					</div> <!-- col.// -->
			 <?php
				}
			 ?>
			 <div class="col-md-6">
						<figure class="itemside  mt-4">
							<a href="orders.php" class="btn btn-primary">View all Recent Orders</a>
						</figure>
					</div> <!-- col.// -->
			</div> <!-- row.// -->

			<!-- <a href="#" class="btn btn-outline-primary btn-block"> See all orders <i class="fa fa-chevron-down"></i>  </a> -->
			</div> <!-- card-body .// -->
		</article> <!-- card.// -->

	</main> <!-- col.// -->
</div>

</div> <!-- container .//  -->
</section>
<!-- ========================= SECTION CONTENT END// ========================= -->

<?php 
	//Including the footer
   include 'inc/footer.php';    
?>

