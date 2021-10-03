<?php  
include('partials/menu.php');
?>


   <!-- main content section start  -->
   <div class="main-content">
   <div class="wrapper">
          <h1>Add Admin </h1>
<br> <br> <br>

<?php

if(isset($_SESSION['add'])){
    echo $_SESSION['add'];
    unset($_SESSION['add']);
 }

?>

<br>
 <br>
 <br>
 
          <form action="" method="POST">

          <table class="tbl-30">
              <tr>
                  <td>Full Name:</td>
                  <td><input type="text" name="fullname" placeholder="write your fullname"></td>
              </tr>

              <tr>
                  <td> Username:</td>
                  <td><input type="text" name="username" placeholder="write your username"></td>
              </tr>

              <tr>
                  <td>Password:</td>
                  <td><input type="password" name="password" placeholder="write your password"></td>
              </tr>

              <tr>
                  <td colspan="2">
                      <input type="submit" name="submit" value="Add Admin" class="btn-secondary" >
                  </td>
                  
              </tr>
          </table>
          </form>
    </div>
    </div>
<?php
   include('partials/footer.php');
   ?>


<?php

// admin info transferring from form to database 

if(isset($_POST['submit'])){
    // Get data from form 
    $fullname = $_POST['fullname'];
    $username = $_POST['username'];
    $password = md5($_POST['password']); //password encrypted by md5
    
    // Sql query to set value in database 

    $sql = "INSERT INTO tbl_admin set 
    fullname = '$fullname',
    username = '$username',
    password = '$password'
    ";

  $res = mysqli_query($conn,$sql) or die(mysqli_error());

  if($res){

    $_SESSION['add'] = "<div class='success'>Admin added successfuly</div>";

    header("location: https://localhost/food-order/admin/manage-admin.php");

  }else {
      
    $_SESSION['add'] = "<div class='error'>Failed to add admin</div>";

    header("location: https://localhost/food-order/admin/add-admin.php");


  }

}

?>