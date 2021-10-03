<?php  
include('partials/menu.php');
?>

   <!-- main content section start  -->
   <div class="main-content">
   <div class="wrapper">
          <h1>Manage Admin</h1>
<br>
<br>
<br>
<?php

if(isset($_SESSION['add'])){
   echo $_SESSION['add'];
   unset($_SESSION['add']);
}

if(isset($_SESSION['delete'])){
   echo $_SESSION['delete'];
   unset($_SESSION['delete']);
}

if(isset($_SESSION['update'])){
   echo $_SESSION['update'];
   unset($_SESSION['update']);
}

if(isset($_SESSION['change'])){
   echo $_SESSION['change'];
   unset($_SESSION['change']);
}
if(isset($_SESSION['pwd_not_match'])){
   echo $_SESSION['pwd_not_match'];
   unset($_SESSION['pwd_not_match']);
}
if(isset($_SESSION['pwd_change'])){
   echo $_SESSION['pwd_change'];
   unset($_SESSION['pwd_change']);
}
?>
<br>
<br>
<br>
          <!-- Buttom to add admin  -->
          <a href="add-admin.php" class="btn-primary">Add Admin</a>
<br>
<br>
<br>
          
          

          <table class="tbl-full">
             <tr>
                <th>S.N</th>
                <th>Fullname</th>

                <th>Username</th>

                <th>Action</th>
             </tr>

             <?php
            // Query to get all admins 
             $sql = "SELECT * FROM tbl_admin";

             $res = mysqli_query($conn,$sql);
             if($res){
               //  count row numbers 
               $count = mysqli_num_rows($res);

               $sn = 1;
               if($count >0){
                  //we have data in database

                  while($rows= mysqli_fetch_assoc($res)){
                     
                     $id = $rows['id'];
                     $fullname = $rows['fullname'];
                     $username = $rows['username'];
                    ?>

            <tr>
                <td><?php echo $sn++;  ?></td>
                <td><?php  echo $fullname ?></td>
                <td><?php echo $username ?></td>
                <td>
                <a href=" <?php echo SITEURL ?>admin/update-password.php?id=<?php echo $id?>" class="btn-primary" >Change Password</a>   
                <a href=" <?php echo SITEURL ?>admin/update-admin.php?id=<?php echo $id?>" class="btn-secondary" >Update Admin</a>
                <a href=" <?php echo SITEURL ?>admin/delete-admin.php?id=<?php echo $id?>" class="btn-danger">Delete Admin</a>
               </td>


             </tr>


<?php

                  }
               }else {
                  // we dont have data in database 
               }


             }else {

             }


            ?>
            
          </table>

        
      </div>

   </div>
   <!-- main content section end  -->

   <?php
   include('partials/footer.php');
   ?>