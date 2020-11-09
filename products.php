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
	<h2 class="title-page">All Products</h2>
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
			<a href="add-product.php" class="float-right btn btn-outline-secondary"> <i class="fa fa-plus"></i> Add New Product</a>
			<strong class="d-inline-block mr-3">All Products </strong>
		</header>
		<div class="table-responsive">
			<?php
				include 'inc/notify.php';
			?>
		<table class="table table-hover">
			<tbody>
					<?php
						//Display all product in products.php
						//SQL
						$sql = "SELECT * FROM products ORDER BY id DESC";
						//Query
						$query = mysqli_query($db_con, $sql);
						//Looping through our data
						while ($result = mysqli_fetch_assoc($query)) {
							//Display data
							?>
							<tr>
								<td width="65">
									<img src="images/uploads/<?php echo $result['product_image']; ?>" class="img-xs border">
								</td>
								<td> 
									<p class="title mb-0"><?php echo $result['title']; ?></p>
									<var class="price text-muted">NG <?php echo $result['price']; ?></var>
								</td>
								<td> Seller <br> <?php echo $_SESSION['fullname']; ?> </td>
								<td width="250"> 
									<a href="product.php?pid=<?php echo $result['id']; ?>" class="btn btn-outline-secondary">View</a> 
									<a href="?delete_product=yes&id=<?php echo $result['id']; ?>" class="btn btn-outline-primary">Delete</a> 
									<a href="edit_product.php?id=<?php echo $result['id']; ?>" class="btn btn-outline-dark">Edit</a> 
								</td>
							</tr>		
							<?php
							//End looping
						}
					?>
			</tbody>
		</table>
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
