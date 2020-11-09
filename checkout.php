<?php 
//CHeck valid file path
define('BASE_PATH', basename(__FILE__) );
//Process Authentication 
include 'inc/cart_process.php';
//Load product data

//Redirect to home page when cart is not set
if (!isset($_SESSION['cart'])) {
	//Redirect to index.php
    header("location: index.php");
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
	<main class="col-md-9">
<div class="card">
<!-- We use ajax form here for paystack -->
<form action="" action="" id="makepayment" class="p-3">
	<div class="row">
		<div class="col">
			<div class="form-group">
				<label for="name">Fullname</label>
				<input type="text" name="name" class="form-control" required placeholder="Enter your full name" id="name">
			</div>
		</div>
		<div class="col">
			<div class="form-group">
				<label for="name">Email</label>
				<input type="email" name="email" class="form-control" required placeholder="Enter your email" id="email">
			</div>
		</div>
	</div>
</form>
<!-- We use ajax form here for paystack ends here -->
<div class="card-body border-top">
	<a href="#" class="btn btn-light"> <i class="fa fa-chevron-left"></i> Continue shopping </a>
</div>	
</div> <!-- card.// -->

<div class="alert alert-success mt-3">
	<p class="icontext"><i class="icon text-success fa fa-truck"></i> Free Delivery within 1-2 weeks</p>
</div>

	</main> <!-- col.// -->
	<aside class="col-md-3">
		<div class="card">
			<div class="card-body">
					<dl class="dlist-align">
						<?php
							$total = 0;
							//Get all cart products
							foreach ($_SESSION['cart'] as $pid => $value) {
								//Get current select product details from base
								//SQL 
								$sql = "SELECT * FROM products WHERE id = '$pid'";
								//Run the Query
								$query = mysqli_query($db_con, $sql) or die("Cart can't connect");
								//Return result into variable $result
								$result = mysqli_fetch_assoc($query);
								//Now get total amount of each products in cart
								$total = $total + ($result['price'] * $value['quantity']);
								
							}
						?>
					  <dt>Total:</dt>
					  <dd class="text-right h5"><strong>₦<?php echo number_format($total); ?></strong></dd>
					</dl>
					<hr>
					<p class="text-center mb-3">
						<img src="https://cyberomin.github.io/assets/article_images/paystack/logo.png" height="26">
					</p>
					<div class="text-center">
						<a href="#" class="btn btn-primary" id="purchasebtn"> Make Purchase <i class="fa fa-chevron-right"></i> </a>
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
<script src="https://js.paystack.co/v1/inline.js"></script>
<script>
	$(document).ready(function () {
		//Trigger submit when make payment button is been clicked
		$("#purchasebtn").click(function (e) { 
			e.preventDefault();
		//Submit details for payment
		var email = $("#email").val();
		var name = $("#name").val();
		//Check if email is empty
		if (email == "") {
			alert("Enter your email"); //display notification
			return; //i.e stop running query
		}else if (name == "") {
			alert("Enter your name"); //i.e display notification
			return; //i.e stop running query
		}
		//Run paystack query
		var handler = PaystackPop.setup({
              key: 'pk_test_6f4b359d153b9ff2e31970e93cf5dd9054693d4e',
              email: email,
              amount: '<?php echo $total; ?>00',
              currency: "NGN",
              ref: ''+Math.floor((Math.random() * 1000000000) + 1), // generates a pseudo-unique reference. Please replace with a reference you generated. Or remove the line entirely so our API will generate one for you
              metadata: {
                 custom_fields: [
                    {
                        display_name: name,
                        variable_name: name,
                    }
                 ]
              },
              callback: function(response){
				//   if transaction successful do this

                //   alert('success. transaction ref is ' + response.reference);
                  var referenceid = response.reference;
				  //Make an http request to cart process
                    $.ajax({
                        type: "POST", //Send in POST Method
                        url: "inc/cart_process.php", //Endpoint for the ajax
                        data: {
                            'checkout' : 'active', //Send checkout is active
							'name' : name, // Submit the customer name
							'email' : email, //Submit the customer email
							'refrence' : referenceid //Payment refrence id for confirmation of payment
                        },
                        beforeSend: function(){
                            console.log("Sending request");
                        },
                        success: function (response) {
							// console.log(response);
							//Check if response is valid
							if (response == "Transaction reference not found") {
								alert("Their is an error with Transaction!");
							}else{
								//Once transaction completed redirect to complete page
								window.location.href = 'complete.php';
							}
                        }
                    });
              },
              onClose: function(){
                 // window.location.href="pay.php";
              }
            });
            handler.openIframe();
			
		});

	});
	
</script>