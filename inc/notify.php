<?php
//Notify success 
if (isset($msg)) {
    ?>
        <div class="alert alert-success">
            <?php echo $msg; ?>
        </div>
    <?php
    //Notify error
}elseif(isset($error)){
    ?>
        <div class="alert alert-danger">
            <?php echo $error; ?>
        </div>
    <?php
}

?>