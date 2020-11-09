<?php
    //Declare session
    session_start();
    //Destroy session
    session_destroy();
    //Return user back to homepage when logout
    header('location: index.php');
?>