<aside class="col-md-3">
		<nav class="list-group">
			<a class="list-group-item <?php echo (BASE_PATH == 'home.php') ? 'active' : '' ; ?>" href="home.php"> Account overview  </a>
			<a class="list-group-item <?php echo (BASE_PATH == 'orders.php') ? 'active' : '' ; ?>" href="orders.php"> My Orders </a>
			<a class="list-group-item <?php echo (BASE_PATH == 'products.php' || BASE_PATH == 'add-product.php') ? 'active' : '' ; ?>" href="products.php"> Products </a>
			<a class="list-group-item <?php echo (BASE_PATH == 'category.php') ? 'active' : '' ; ?>" href="category.php"> Product Category </a>
			<a class="list-group-item <?php echo (BASE_PATH == 'profile.php') ? 'active' : '' ; ?>" href="profile.php"> Settings </a>
			<a class="list-group-item <?php echo (BASE_PATH == '') ? 'active' : '' ; ?>" href="logout.php"> Log out </a>
		</nav>
</aside> <!-- col.// -->