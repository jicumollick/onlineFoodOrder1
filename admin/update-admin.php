<?php  
include('partials/menu.php');
?>

  <!-- main content section start  -->
  <div class="main-content">
   <div class="wrapper">
          <h1>Update Admin </h1>
<br> <br> <br>
<?php

// Get the id of selected admin 
$id = $_GET['id'];
// create sql query to get the details 

$sql = "SELECT * FROM tbl_admin WHERE id=$id";

// execute the query 

$res = mysqli_query($conn,$sql);

if($res){

$count = mysqli_num_rows($res);

if($count){

    // echo "admin available";

    $row= mysqli_fetch_assoc($res);

    $fullname= $row['fullname'];
    $username = $row['username'];
}
}else {
    header("location: https://localhost/food-order/admin/manage-admin.php");


}
?>
<form action="" method="POST">
    <table class="tbl-30">
        <tr>
            <td>Full Name:</td>
            <td>
                <input type="text" name="fullname" value="<?php echo $fullname?>">
            </td>
        </tr>
        <tr>
            <td>Username:</td>
            <td>
                <input type="text" name="username" value="<?php echo $username?>">
            </td>
        </tr>
        <tr>
            
            <td colspan="2">
                <input type="hidden" name="id" value="<?php echo $id ?>">
                <input type="submit" name="submit" value="Update Admin">
            </td>
        </tr>
    </table>

</form>

<?php

if(isset($_POST['submit'])){
    // echo "Button clicked";

     $id = $_POST['id'];
     $fullname = $_POST['fullname'];
     $username = $_POST['username'];

     $sql = "UPDATE tbl_admin SET
     fullname= '$fullname',
     username= '$username'
     where id='$id'
     ";

     $res= mysqli_query($conn,$sql);

     if($res){

        $_SESSION['update']= "<div class='success'>Admin updated successfuly</div>";
        header('location: https://localhost/food-order/admin/manage-admin.php');

     }else {
        $_SESSION['update']= "<div class='error'>Failed to update admin</div>";
        header('location: https://localhost/food-order/admin/manage-admin.php');


     }


}
?>

<?php
   include('partials/footer.php');
   ?>