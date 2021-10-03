<?php
include('../config/constants.php');

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Food Order System</title>
     <link rel="stylesheet" href="../css/admin.css">       
</head>
<body>

<div class="login">
    <h1 class="text-center">Login</h1>
    <br> <br>

    <?php

if(isset($_SESSION['login'])){
    echo $_SESSION['login'];
    unset ($_SESSION['login']);
}

if(isset($_SESSION['no-login'])){
    echo  $_SESSION['no-login'];
    unset($_SESSION['no-login']);
}
    ?>
    <br> <br>
    <form action="" method="POST" class="text-center">
        Username: <br>
        <input type="text" name="username" placeholder="Enter Username"> <br><br>
        Password: <br>
        <input type="password" name="password" placeholder="Enter Password"> <br> <br> 
        
        <input type="submit" name="submit" value="Login" class="btn-primary">
    </form>
</div>
    
</body>
</html>

<?php

if(isset($_POST['submit'])){

    // Get the data from form 

    $username = mysqli_real_escape_string($conn,$_POST['username']);
    $password= mysqli_real_escape_string($conn,md5($_POST['password']));

    // check user exists or not 

    $sql= "SELECT * FROM tbl_admin WHERE username='$username' and password='$password'";

    $res = mysqli_query($conn,$sql) or die('query failed');

    $count = mysqli_num_rows($res);
    
    if($count){
        
// user available and login success 
$_SESSION['login']="<div class='success'>Loigin Successful</div>";
$_SESSION['user'] = $username;
header('location:https://localhost/food-order/admin/index.php');

    }else{
        // user not available 
        $_SESSION['login']="<div class='error'>Loigin Failed,,,,Try Again</div>";
header('location:https://localhost/food-order/admin/login.php');


    }
}

?>