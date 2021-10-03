<?php  
include('partials/menu.php');
?>

  <!-- main content section start  -->
  <div class="main-content">
   <div class="wrapper">
          <h1>Manage Order</h1>

  
<br>
<br>
<br>
    <?php
    
    if(isset($_SESSION['update'])){
       echo $_SESSION['update'];
       unset($_SESSION['update']);
    }
    ?>
          

          <table class="tbl-full" style=>
             <tr>
                <th>S.N</th>
                <th>Food</th>

                <th>price</th>

                <th>qty</th>
                <th>total</th>

                <th>order date</th>
                <th>status</th>

                <th>customer name</th>

                <th>customer contact </th>

                <th>Email</th>
                <th> Address</th>
                <th> action</th>
             </tr>

             <?php

             $sql= "SELECT * FROM tbl_order ORDER BY id DESC";

             $res = mysqli_query($conn,$sql);

             $count = mysqli_num_rows($res);
             $sn=1;
             if($count > 0){

               while($row=mysqli_fetch_assoc($res)){

                  $id = $row['id'];
                  $food = $row['food'];
                  $price = $row['price'];
                  $qty = $row['qty'];
                  $total = $row['total'];
                  $order_date = $row['order_date'];
                  $status = $row['status'];
                  $customer_name = $row['customer_name'];
                  $customer_contact = $row['customer_contact'];
                  $customer_email = $row['customer_email'];

                  $customer_address = $row['customer_address'];

                  ?>

               <tr>
                     <td><?php echo $sn++; ?></td>
                     <td><?php echo $food; ?></td>
                     <td><?php echo $price; ?></td>
                     <td><?php echo $qty; ?></td>
                     <td><?php echo $total; ?></td>
                     <td><?php echo $order_date; ?></td>
                     <td><?php echo $status; ?></td>
                     <td><?php echo $customer_name; ?></td>
                     <td><?php echo $customer_contact; ?></td>
                     <td><?php echo $customer_email; ?></td>
                     <td><?php echo $customer_address; ?></td>
                     

                     <td><a href="https://localhost/food-order/admin/update-order.php?id=<?php echo $id; ?>" class="btn-secondary" >Update Order</a>
                     </td>


             </tr>
                  <?php

               }


             }else {
                echo "<tr colspan='12'><td>Order Not Available</td></tr>";
             }



            ?>
             
          </table>
      </div>

   </div>
   <!-- main content section end  -->
   <?php
   include('partials/footer.php');
   ?>