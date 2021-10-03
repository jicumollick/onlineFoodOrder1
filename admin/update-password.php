<?php  
include('partials/menu.php');
?>

<!-- main content section start  -->
<div class="main-content">
   <div class="wrapper">
          <h1>Change Password </h1>
<br> <br> <br>

<?php   

if(isset($_GET['id'])){
    $id = $_GET['id'];
}
?>


<form action="" method="POST">

<table class="tbl-30">
    <tr>
        <td>Current Password</td>
        <td>
            <input type="password" name="current_password" placeholder="Current Password">
        </td>
    </tr>

    <tr>
        <td>New Password</td>
        <td>
            <input type="password" name="new_password" placeholder="New Password">
        </td>
    </tr>

    <tr>
        <td>Confirm Password</td>
        <td>
            <input type="password" name="confirm_password" placeholder="Confirm Password">
        </td>
    </tr>

    <tr>
        <td colspan="2">
            <input type="hidden" name="id" value="<?php echo $id ?>">
            <input type="submit" name="submit" value="Change Password">
        </td>
    </tr>
</table>
</form>


<?php

if(isset($_POST['submit'])){
      // 1.Get the data from the form 

      $id= $_POST['id'];
      $current_password= md5($_POST['current_password']);
      $new_password= md5($_POST['new_password']);
  
      $confirm_password= md5($_POST['confirm_password']);
  
  
      // 2.check whether the current user exists of not 
  
      $sql= "SELECT * FROM tbl_admin WHERE id=$id and password='$current_password'";
  
      $res = mysqli_query($conn,$sql) or die(mysqli_error());
  
      if($res){
  
          $count= mysqli_num_rows($res);
          
          if($count){
              // user exist and password can be changed. 
            //   echo "user found";
      // 3.check cofirm password and new password

      if($new_password==$confirm_password){
        //   update the password 
        $sql2= "UPDATE tbl_admin SET
        password='$new_password'
        WHERE id=$id";

        $res2= mysqli_query($conn,$sql2);


        if($res2){
             //   redirect to manage admin page 
        $_SESSION['pwd_change']= "<div class='success'>Password changed sucessfully</div>";
        // redirect the user 
        header("location: https://localhost/food-order/admin/manage-admin.php");
        

        }else{
            // display error message 
            
             //   redirect to manage admin page 
        $_SESSION['pwd_change']= "<div class='error'>Password change Failed</div>";
        // redirect the user 
        header("location: https://localhost/food-order/admin/manage-admin.php");
        
        }
      }else{
        //   redirect to manage admin page 
        $_SESSION['pwd_not_match']= "<div class='error'>new and confirm password didn't match, try again</div>";
        // redirect the user 
        header("location: https://localhost/food-order/admin/manage-admin.php");
        

      }

          }else{
              $_SESSION['change']= "<div class='error'>user not found</div>";
              // redirect the user 
              header("location: https://localhost/food-order/admin/manage-admin.php");
              
          }
      }
      // 3.check cofirm password and new password
      
      
      // 4.change password
    
}

?>

<?php
   include('partials/footer.php');
   ?>