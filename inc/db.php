<?php
    //Declaring database connection variable
    $db_host = 'localhost';
    $db_username = 'u380882461_biggi_ecommerc';
    $db_password = '1Biggi_ecommerc';
    $db_database = 'u380882461_biggi_ecommerc';
    //Making the connection
    $db_con = mysqli_connect($db_host, $db_username, $db_password, $db_database) or die('Cant caonnect to the database'); //Display error if connection fail
?>