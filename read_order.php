
<?php

include('config.php');

?>


<!DOCTYPE html>
<html>
<head>
    <title>Read Data</title>

     <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

<!-- custom css file link  -->
<link rel="stylesheet" href="css/style.css">
</head>
<body>





<?php

      $select = mysqli_query($conn, "SELECT * FROM userorder");
      
      ?>
      <div class="product-display products_table" id="product_table">
         <table class="product-display-table">
            <thead>
            <tr>
                <th>Name</th>
                <th>Phone Number</th>
                <th>Username</th>
                <th>Quantity</th>
            </tr>
            </thead>
            <?php while($row = mysqli_fetch_assoc($select)){ ?>
            <tr>
                
               <td><?php echo $row['name']; ?></td>
               <td><?php echo $row['phonenumber']; ?>/-</td>
               <td><?php echo $row['username']; ?></td>
               <td><?php echo $row['quantity']; ?></td>
            </tr>
         <?php } ?>
         </table>

      </div>
 
</body>
</html>
