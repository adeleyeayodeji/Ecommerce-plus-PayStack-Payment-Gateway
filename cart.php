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
    <!-- ========================= SECTION CONTENT ========================= -->
    <section class="section-content padding-y">
        <div class="container">

            <div class="row">
                <main class="col-md-12">
                    <div class="card">
                        <?php
                            include 'inc/notify.php';
                        ?>
                        <table class="table table-borderless table-shopping-cart">
                            <thead class="text-muted">
                                <tr class="small text-uppercase">
                                    <th scope="col">Product</th>
                                    <th scope="col" width="120">Quantity</th>
                                    <th scope="col" width="120">Price</th>
                                    <th scope="col" class="text-right" width="200"> </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    //Check if session cart is active
                                    if (isset($_SESSION['cart'])) {
                                    //Loop all cart product for checkout
                                    foreach ($_SESSION['cart'] as $pid => $value) {
                                        //Get current select product details from base
                                        //SQL 
                                        $sql = "SELECT * FROM products WHERE id = '$pid'";
                                        //Run the Query
                                        $query = mysqli_query($db_con, $sql) or die("Cart can't connect");
                                        //Return result into variable $result
                                        $result = mysqli_fetch_assoc($query);
                                        //Now dump data to table in readable format
                                        ?>
                                            <tr>
                                            <td>
                                                <figure class="itemside">
                                                    <div class="aside"><img src="images/uploads/<?php echo $result['product_image']; ?>" class="img-sm"></div>
                                                    <figcaption class="info">
                                                        <a href="product.php?pid=<?php echo $result['id']; ?>" class="title text-dark"><?php echo $result['title']; ?></a>
                                                        <p class="small text-muted">Short Desc: <?php echo substr($result['description'], 0, 15); //Shorten the description to 15 lenght ?>...</p>
                                                    </figcaption>
                                                </figure>
                                            </td>
                                            <td>
                                                <input type="number" value='<?php echo $value['quantity']; ?>' class="form-control text-center" readonly id="">
                                            </td>
                                            <td>
                                                <div class="price-wrap">
                                                    <!-- Price multiply by quantity -->
                                                    <var class="price">₦<?php echo $result['price'] * $value['quantity']; ?>.00</var>
                                                    <!-- Price per each -->
                                                    <small class="text-muted"> ₦<?php echo $result['price']; ?>.00 each</small>
                                                </div>
                                                <!-- price-wrap .// -->
                                            </td>
                                            <td class="text-right">
                                                <form action="" method="post" class="p-0 m-0">
                                                    <input type="hidden" name="pid" value="<?php echo $result['id']; ?>">
                                                    <!-- Edit product button -->
                                                    <a data-original-title="Edit Product" title="" href="product.php?pid=<?php echo $result['id']; ?>" class="btn btn-light" data-toggle="tooltip"> <i class="fa fa-pen"></i></a>
                                                    <!-- Edit product button end here -->
                                                    <button type="submit" name="removecart" class="btn btn-light btn-round"> Remove</button>
                                                </form>
                                            </td>
                                        </tr>
                                        <?php
                                    }
                                 //If session cart is active ends here      
                                }
                                ?>
                            </tbody>
                        </table>

                        <div class="card-body border-top">
                            <a href="checkout.php" class="btn btn-primary float-md-right"> Checkout <i class="fa fa-chevron-right"></i> </a>
                            <a href="index.php" class="btn btn-light"> <i class="fa fa-chevron-left"></i> Continue shopping </a>
                        </div>
                    </div>
                    <!-- card.// -->

                </main>
            </div>

        </div>
        <!-- container .//  -->
    </section>
    <!-- ========================= SECTION CONTENT END// ========================= -->

<?php
    include 'inc/footer.php';
?>
