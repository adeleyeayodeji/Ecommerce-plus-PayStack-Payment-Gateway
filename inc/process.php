<?php
    session_start();
    //Including database connection
    include 'db.php';

    //Login Authentication Query
    if ( isset($_POST['login']) ) {
        //If user is ready for login, do this
        $email = $_POST['email'];
        //Encrypting the user password with md5() php function
        $password = md5($_POST['password']);
        //Running queries to check if credientials is valid
        $sql = "SELECT * FROM users WHERE email = '$email' AND password = '$password'";
        //Declaring the queries for validation
        $mysqli_query = mysqli_query($db_con, $sql) or die('Cant access users details');
        //Returning the result from the database as an object array
        $result = mysqli_fetch_assoc($mysqli_query);
        //Check if result is not NULL i.e empty
        if ($result != NULL) {
            //DO TRUE
            // == DECLARE PHP SESSION VARIABLE == 
            $_SESSION['fullname'] = $result['fullname']; //Storing users fullname in SESSION VARIABLE $_SESSION['fullname']
            $_SESSION['email'] = $result['email']; //Storing users email in SESSION VARIABLE $_SESSION['email']
            //Redirect after successfull login
            header('location: home.php');
        }else{
            //DO FALSE
            $msg = 'User not found';
        }
    }

    //If admin details need update
    if (isset($_POST['updateadmin'])) {
        //get the details from form
        $email = $_POST['email'];
        $fullname = $_POST['fullname'];
        //Update in Database
        $sql = "UPDATE users SET fullname = '$fullname', email = '$email' WHERE email = '$email'";
        //Run query
        $query = mysqli_query($db_con, $sql) or die('Cant connect');
        //If details updated successfully
        if ($query) {
            //Update the current session data 
            $_SESSION['fullname'] = $fullname;
            //Notify
            $msg = "Details updated";
        }else{
            //Error if cant update
            $error = "Error updating data";
        }

    }

    //Add category
    if (isset($_POST['addcategory'])) {
        //Category input value
        $category = $_POST['category'];
        //SQL
        $sql = "INSERT INTO category(name) VALUES('$category')";
        //Query 
        $query = mysqli_query($db_con, $sql) or die('Error creating category');
        //If successfully added to category
        if ($query) {
            //Display message
            $msg = "Category added successfully";
        }else{
            //Display error
            $error = "Error creating category";
        }
    }
    
    //Delete Category
    if (isset($_GET['delete'])) {
        //Get category id to be deleted
        $category_id = $_GET['id'];
        //SQL
        $sql = "DELETE FROM category WHERE id = '$category_id'";
        //Run query
        $query = mysqli_query($db_con, $sql) or die('Cant delete category');
        //If successfully deleted
        if ($query) {
            //Display message
            $msg = "Successfully deleted";
        }else{
            $error = "Error deleting category";
        }
    }

    //Edit category
    if (isset($_GET['edit'])) {
        //Get category to be edited
        $category_id = $_GET['id'];
        //Get current file name
        $sql = "SELECT * FROM category WHERE id = '$category_id'";
        //Run the query
        $query = mysqli_query($db_con, $sql);
        //Return the result selected
        $Edit_result = mysqli_fetch_assoc($query);
    }

      //update category
      if (isset($_POST['updatecategory'])) {
        //Category input value
        $category = $_POST['category'];
        $category_id = $_POST['category_id'];
        //SQL
        $sql = "UPDATE category SET name = '$category' WHERE id = '$category_id'";
        //Query 
        $query = mysqli_query($db_con, $sql) or die('Error updating category');
        //If successfully added to category
        if ($query) {
            //Display message
            $msg = "Category updated successfully";
        }else{
            //Display error
            $error = "Error creating category";
        }
    }

    //Add new product
    if (isset($_POST['addproduct'])) {
        //Get all values from form
        $title = filter_var($_POST['title'], FILTER_SANITIZE_STRING);
        $price = $_POST['price'];
        $description = filter_var($_POST['description'], FILTER_SANITIZE_STRING);
        $category = $_POST['category'];
        //Handling images files
        $image_file = $_FILES['filename']['name'];
        //Rewriting file name
        $extension = explode(".",$image_file);
        $new_file = $extension[0]."_new_".md5(time());
        //Concatinatinate the current extension
        $newname = $new_file.'.'.$extension[1];
        //Product image done generating name
        $product_image = $newname;
        //Move uploaded file to a nice directory
        $targetPath = "images/uploads/".basename($product_image);
        $saved = move_uploaded_file($_FILES['filename']['tmp_name'], $targetPath);
        if ($saved) {
            //If image uploaded successfully then add data to base
            //SQL
             $sql = "INSERT INTO products(title, category, price, product_image, description) VALUES('$title', '$category', '$price', '$product_image', '$description')";
            //Query 
            $query = mysqli_query($db_con, $sql) or die('Cant Connect to base');
            //If query succeeded
            if ($query) {
                //Display alert
                $msg = "Product published successfully";
            }else{
                //Display error
                $error = "Error publishing product";
            }
        }else{
             //Display error
             $error = "Error publishing product";
        }
    }

    //Delete product action
    if (isset($_GET['delete_product'])) {
        //Get id of product to delete
        $id = $_GET['id'];
        //SQL
        $sql = "DELETE FROM products WHERE id = '$id'";
        //Query
        $query = mysqli_query($db_con, $sql);
        //If product deleted successfully
        if ($query) {
            $msg = "Product deleted";
        }else{
            $error = "Error deleting product";
        }
    }

    //Category functions
    function ShowCategory($id)
    {
        // Including db for functions
        include 'db.php';
        //SQL
        $sql = "SELECT * FROM category WHERE id = '$id'";
        //Run the query
        $query = mysqli_query($db_con, $sql);
        //Get result 
        $result = mysqli_fetch_assoc($query);
        //Return result
        return $result['name'];
    }

    //Update product from edit page
    if (isset($_POST['edit_product'])) {
        //Get current product id
        $pid = $_POST['pid'];
        //Get all values from edit form
        $title = htmlentities($_POST['title']);
        $price = $_POST['price'];
        $description = htmlentities($_POST['description']);
        $category = $_POST['category'];
        //Define old product image 
        $old_product_image = $_POST['old_product_image'];
        //Check if image input value is empty
        if (isset($_FILES['filename']['name']) && $_FILES['filename']['name'] != "") {
            // Delete the old product image
            unlink("images/uploads/".$old_product_image);
            //Get current product picture
            $image_file = $_FILES['filename']['name'];
            //Rewriting file name
            $extension = explode(".",$image_file);
            $new_file = $extension[0]."_new_".md5(time());
            //Concatinatinate the current extension
            $newname = $new_file.'.'.$extension[1];
            //Product image done generating name
            $product_image = $newname;
             //Move uploaded file to a nice directory
            $targetPath = "images/uploads/".basename($product_image);
            $saved = move_uploaded_file($_FILES['filename']['tmp_name'], $targetPath);
        }else{
            //Continue update with old image
            $product_image = $old_product_image;
        }
        //SQL
        $sql = "UPDATE products SET title = '$title', category = '$category', price = '$price', product_image = '$product_image', description = '$description' WHERE id '$pid'";
        //Query
        $query = mysqli_query($db_con, $sql);
         //If query succeeded
         if ($query) {
            //Display alert
            $msg = "Product updated successfully";
            //Refresh page with submitting content
            echo "<meta http-equiv='refresh' content='0'>";
        }else{
            //Display error
            $error = "Error updating the product";
        }
    }

       //Delete product orders
       if (isset($_GET['delete_pid'])) {
        //Get id of product to delete
        $id = $_GET['delete_pid'];
        //SQL
        $sql = "DELETE FROM orders WHERE id = '$id'";
        //Query
        $query = mysqli_query($db_con, $sql);
        //If product deleted successfully
        if ($query) {
            $msg = "Product deleted";
        }else{
            $error = "Error deleting product";
        }
    }
?>