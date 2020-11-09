<?php
    //Include core process for db connection
    include 'process.php';

    //if add to cart is clicked
    if (isset($_POST['addtocart'])) {
        //Get the current quantity selected
        $quantity = $_POST['quantity'];
        //Get product id
        $pid = $_POST['pid'];
        //Now add it to cart
        //We declare a new cart session with a valid key which is the product id
        $_SESSION['cart'][$pid] = array('quantity' => $quantity);
        //if cart added successfully
        $msg = "Product added to cart <a href='cart.php' class='font-weight-bold float-right'>Go to Cart</a>";
    }

    //If remove cart is clicked
    if (isset($_POST['removecart'])) {
        //Get product id to be remove from cart
        $pid = $_POST['pid'];
        //Remove from cart session
        unset($_SESSION['cart'][$pid]);
        //If successfully removed from cart
        $msg = "Product removed successfully";
    }

    //if checkout is active
    if (isset($_POST['checkout'])) {
        //Check if the transaction was successful
        $curl = curl_init();
        $refrence = $_POST['refrence'];
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.paystack.co/transaction/verify/".$refrence,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
            "Authorization: Bearer sk_test_49dbf0b252a17f1215cbd4ffe3b7e21cbad45e1c",
            "Cache-Control: no-cache",
            ),
        ));
        
        $response = curl_exec($curl);
        curl_close($curl);
        //Decode current result into readable object format
        $readable = json_decode($response);
        //Checking errors
        if ($readable->status == false) {
            echo $readable->message;
        }elseif($readable->status == true){
            //Run the internal query

            //Get customer details
            $email = $_POST['email'];
            $name = $_POST['name'];
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
                $total = ($result['price'] * $value['quantity']);
                //Insert details into database
                //Database Variable
                $product_id = $pid;
                $quantity = $value['quantity'];
                $customer_email = $email;
                $customer_name = $name;
                //SQL
                $sql = "INSERT INTO orders(pid, quantity, customer_email, customer_name) VALUES('$product_id', '$quantity', '$customer_email', '$customer_name')";
                //QUery
                $query = mysqli_query($db_con, $sql) or die('Cant insert to oreders');
            }
            //Once inserted unset $_SESSION CART
            unset($_SESSION['cart']);
            //Send a response of confirmation
            echo json_encode(array('info' => 'transaction completed'));
        }
    }

?>