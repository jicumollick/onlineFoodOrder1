<?php  
include('partials/menu.php');
?>

  <!-- main content section start  -->
  <div class="main-content">
   <div class="wrapper">
          <h1>Manage category</h1>

          <br>
<br>
<br>



<?php

        if(isset($_SESSION['add'])){
            echo $_SESSION['add'];
            unset($_SESSION['add']);
        }
      
        if(isset($_SESSION['remove'])){
         echo $_SESSION['remove'];
         unset($_SESSION['remove']);
     }
     if(isset($_SESSION['delete'])){
      echo $_SESSION['delete'];
      unset($_SESSION['delete']);
     }

     if(isset($_SESSION['no-category-found'])){
      echo $_SESSION['no-category-found'];
      unset($_SESSION['no-category-found']);
     }

     if(isset($_SESSION['update'])){
      echo $_SESSION['update'];
      unset($_SESSION['update']);
     }

     if(isset($_SESSION['upload'])){
      echo $_SESSION['upload'];
      unset($_SESSION['upload']);
     }

     if(isset($_SESSION['failed-remove'])){
      echo $_SESSION['failed-remove'];
      unset($_SESSION['failed-remove']);
     }

        ?>

        <br> <br>
          <!-- Buttom to add admin  -->
          <a href="https://localhost/food-order/admin/add-category.php" class="btn-primary">Add Category</a>
<br>
<br>
<br>
          
          

          <table class="tbl-full">
             <tr>
                <th>S.N</th>
                <th>Title</th>

                <th>Image</th>

                <th>Featured</th>
                <th>Active</th>
                <th>Actions</th>


             </tr>

             <?php

             $sql= "SELECT * FROM tbl_category";

             $res = mysqli_query($conn,$sql);

             $count = mysqli_num_rows($res);

             $sn = 1;

             if($count>0){

               while($row= mysqli_fetch_assoc($res)){
                  $id = $row['id'];
                  $title = $row['title'];
                  $image_name= $row['image_name'];
                  $featured = $row['featured'];
                  $active = $row['active'];

                  ?>
            <tr>
                <td> <?php echo $sn++ ?></td>
                <td><?php echo $title ?></td>

                <td>
                   <?php
                  // check image name availavility to show
                  
                  if($image_name!=""){

                     ?>
                     <img src="https://localhost/food-order/images/category/<?php echo $image_name;?>" alt="something wrong" width="100px">sss

                     <?php

                  }else {
                     echo "<div class='error'>image isn't available</div>";
                  }

                    ?>
                  </td>

                <td><?php echo $featured ?></td>

                <td><?php echo $active ?></td>

                <td><a href="https://localhost/food-order/admin/update-category.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name; ?>" class="btn-secondary" >Update Category</a>
                <a href="https://localhost/food-order/admin/delete-category.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name; ?>" class="btn-danger">Delete Category</a></td>


             </tr>

                  <?php




               }
             }else {
                ?>

                <tr>
                   <td colspan="6"><div class="error">No Category Added</div></td>
                </tr>

                <?php
             }

             ?>
            

          </table>
        
      </div>

   </div>
   <!-- main content section end  -->
   <?php
   include('partials/footer.php');
   ?>