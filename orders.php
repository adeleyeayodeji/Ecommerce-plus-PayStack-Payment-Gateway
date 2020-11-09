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
	<h2 class="title-page">Order Reports</h2>
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
			<a href="orders.php" class="float-right btn btn-dark"> <i class="fa fa-refresh"></i> Refresh</a>
			<strong class="d-inline-block mr-3">Recent Orders</strong>
		</header>
		<div class="table-responsive">
			<?php
				//Include notification
				include 'inc/notify.php';
			?>
		<table class="table table-hover">
			<tbody>
				<?php
					//loop through oreders from database
					//SQL
					$sql = "SELECT * FROM orders ORDER BY pid DESC";
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
						<tr>
							<td width="65">
								<img src="images/uploads/<?php echo $p_result['product_image']; ?>" class="img-xs border">
							</td>
							<td> 
								<p class="title mb-0"><?php echo $p_result['title']; ?></p>
								<var class="price text-muted">₦ <?php echo number_format($p_result['price']); ?></var>
							</td>
							<td> <?php echo $result['customer_name']; ?> <br> <?php echo $result['customer_email']; ?> </td>
							<td width="250"> 
								<a href="?delete_pid=<?php echo $result['id']; //Delete the current orders  ?>" class="btn btn-outline-primary">Delete</a> 
								<a href="product.php?pid=<?php echo $pid; ?>" class="btn btn-outline-secondary">View</a> 
							</td>
						</tr>
						<?php
					}
				?>
		</tbody></table>
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
