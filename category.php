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
	<h2 class="title-page">Product Category</h2>
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
			<strong class="d-inline-block mr-3">Manage Category</strong>
            <a href="category.php" class="float-right btn btn-outline-secondary"> <i class="fa fa-refresh"></i> Refresh</a>
        </header>
		<div class="row">
            <div class="col p-4">
               <?php
                 //If edit is set show edit form
                if (isset($_GET['edit'])) {
                    ?>
                     <form action="" method="POST">
                        <?php
                            include 'inc/notify.php';
                        ?>
                        <div class="form-group">
                            <label for="name" class="btn btn-dark">Edit <?php echo $Edit_result['name']; ?></label> 
                            <input type="text" name="category" placeholder="Enter new category" value="<?php echo $Edit_result['name']; ?>" required class="form-control" id="">
                            <input type="hidden" name="category_id" value="<?php echo $Edit_result['id']; ?>">
                        </div>
                        <div class="form-group">
                            <input type="submit" name="updatecategory" class="btn btn-primary" value="Update Category">
                        </div>
                    </form>
                    <?php
                }else{
                    //Do this if the form is not active
                    ?>
                     <form action="" method="POST">
                        <?php
                            if (isset($msg)) {
                                ?>
                                    <div class="alert alert-success">
                                        <?php echo $msg; ?>
                                    </div>
                                <?php
                            }elseif(isset($error)){
                                ?>
                                    <div class="alert alert-danger">
                                        <?php echo $error; ?>
                                    </div>
                                <?php
                            }
                        ?>
                        <div class="form-group">
                            <label for="name" class="btn btn-dark">Category Name</label> 
                            <input type="text" name="category" placeholder="Enter new category" required class="form-control" id="">
                        </div>
                        <div class="form-group">
                            <input type="submit" name="addcategory" class="btn btn-primary" value="Add Category">
                        </div>
                    </form>
                    <?php
                }

                ?>
            </div>
            <div class="col p-4">
            <!-- Introducing Datatable -->
            <table id="myTable" class="table table-striped table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th>Category</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                        //SQL for all category
                        $sql = "SELECT * FROM category";
                        //Query to execute
                        $query = mysqli_query($db_con, $sql) or die('Cant access category');
                        //Dump all result into $result
                        //Display result
                        while ($result = mysqli_fetch_assoc($query)) {
                                ?>
                                <tr>
                                    <td>
                                        <?php echo $result['name']; ?>
                                    </td>
                                    <td>
                                        <a href="?delete=yes&id=<?php echo $result['id']; ?>" class="btn btn-outline-primary">Delete</a> 
                                        <a href="?edit=yes&id=<?php echo $result['id']; ?>" class="btn btn-outline-secondary ">Edit</a>
                                    </td>
                                </tr>

                                <?php
                        }
                    ?>
                </tbody>
            </table>
            </div>
        </div>
		</article> <!-- card order-item .// -->
	</main> <!-- col.// -->
</div>

</div> <!-- container .//  -->
</section>
<!-- ========================= SECTION CONTENT END// ========================= -->
<?php
	include 'inc/footer.php';
?>
