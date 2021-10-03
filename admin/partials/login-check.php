
<?php

// Authorization check 
// is user logged in or not 
if(!isset($_SESSION['user'])){

    $_SESSION['no-login']= "Login to Access admin panel";
    header('location:https://localhost/food-order/admin/login.php');

}

?>