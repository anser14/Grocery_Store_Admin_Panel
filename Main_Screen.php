<?php

include('config.php');

if(isset($_POST['add_category'])){

   $product_name = $_POST['product_name'];
   $product_discription = $_POST['product_discription'];
   $product_image = $_FILES['product_image']['name'];
   $product_image_tmp_name = $_FILES['product_image']['tmp_name'];
   $product_image_folder = 'uploaded_img/'.$product_image;

   if(empty($product_name) || empty($product_discription) || empty($product_image)){
      $message[] = 'please fill out all';
   }else{
      $insert = "INSERT INTO category(name, discription, image) VALUES('$product_name', '$product_discription', '$product_image')";
      $upload = mysqli_query($conn,$insert);
      if($upload){
         move_uploaded_file($product_image_tmp_name, $product_image_folder);
         $message[] = 'New Category Added Successfully';
      }else{
         $message[] = 'Could not Add the Category';
      }
   }

};

if(isset($_POST['add_product'])){

   $product_name = $_POST['product_name'];
   $product_price = $_POST['product_price'];
      $product_desc = $_POST['product_desc'];
   $catagory = $_POST['category'];
   $product_image = $_FILES['product_image']['name'];
   $product_image_tmp_name = $_FILES['product_image']['tmp_name'];
   $product_image_folder = 'uploaded_img/'.$product_image;

   if(empty($product_name) || empty($product_price) || empty($product_image) || empty($catagory)){
      $message[] = 'please fill out all';
   }else{
      $insert = "INSERT INTO products(name, price, image,catagory,product_desc) VALUES('$product_name', '$product_price', '$product_image','$catagory','$product_desc')";
      $upload = mysqli_query($conn,$insert);
      if($upload){
         move_uploaded_file($product_image_tmp_name, $product_image_folder);
         $message[] = 'new product added successfully';
      }else{
         $message[] = 'could not add the product';
      }
   }

};

?>



<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Category Admin Page</title>
   <script src="https://kit.fontawesome.com/cc165ef527.js" crossorigin="anonymous"></script>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">
   <style>
      #productform {
         position: absolute;
         top: 50%;
         left: 50%;
         transform: translate(-50%, -50%);
         display: none;
      }

      .parentbtn {
         display: flex;
         align-items: center;
         justify-content: space-evenly;
         flex-direction: column;
         width: 100%;
      }

      .parentbtn .btn {
         display: inline-block;
         width: 100%;
      }

      #categoryform {
         position: absolute;
         top: 50%;
         left: 50%;
         transform: translate(-50%, -50%);
         display: none;
      }

      .products_table {
         display: none;
         width: 100% !important;

      }

      .product-display {
         width: 100%;
      }

      .catagory_table {
         display: none;

      }

      .toggle {
         display: block;
      }

      .container1 {
         width: 25% !important;
         display: flex;
         position: relative;
         flex-direction: row !important;
         

      }

      .labl {
         color: rgb(0, 0, 0);
         font-size: 30px;
         cursor: pointer;
         float: left;
         margin: 8px 50px;

      }

      .ch {
         display: none;
         /* float: right; */
      }

 

      .admin-product-form-container {
         /* position: fixed; */
         height: 100vh;
         width: 100%;
         transition: all 1s ease-in-out !important;
         background: #eeee;
         display: flex;
         align-items: center;
         justify-content: start;
         flex-direction: column;


      }

      .btn {
         width: 80% !important;
      }

      .nav {
         width: 100%;
         height: 50px;
         background: #eee;
         /* position: fixed; */
      }


      .togg {
         display: none;
         position: absolute !important;
         top: 40px !important;
         left: -400px !important;

      }
   
      @media (max-width:576px) {
.btn{
   font-size: 10px;
   text-align: left;
}
    
   }
      .parent{
         width: 100%;
         display: flex;
         
      }
      .toggg{
         display: none !important;
      }
      .index{
         z-index: 999;
      }
      .btnclose{
         background: red !important;
      }
      select{
         width: 100%;
         height: 30px;
         border-radius: 5px;
      }
      #catagory_table{
          height:90vh !important;
          overflow:scroll !important;
          box-shadow:0 0 5px #eee;
      }
   </style>
</head>

<body>
  



   <div class="admin-product-form-container" id="categoryform">
   



      <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data">
         <h3>Add a New Category</h3>
         <input type="text" placeholder="Enter Category Name" name="product_name" class="box">
         <input type="text" placeholder="Enter Category Discription" name="product_discription" class="box">
         <input type="file" accept="image/png, image/jpeg, image/jpg" name="product_image" class="box">
         <input type="submit" class="btn" name="add_category" value="Add Category">
         <button onclick="clos()" class="btn btnclose">close</button>
      </form>

   </div>



   <div class="admin-product-form-container" id="productform">
      
      <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data">
         <h3>Add a New Product</h3>

         <?php 
    $query ="SELECT name FROM category";
    $result = $conn->query($query);
    if($result->num_rows> 0){
      $options= mysqli_fetch_all($result, MYSQLI_ASSOC);
    }
?>


         <select name="category">

            <?php 
  foreach ($options as $option) {
  ?>
            <option>
               <?php echo $option['name']; ?>
            </option>
            <?php 
    }
   ?>
         </select>




         <input type="text" placeholder="Enter Product Name" name="product_name" class="box">
         <input type="number" placeholder="Enter Product Price" name="product_price" class="box">
         <input type="text" placeholder="Enter Product Description" name="product_desc" class="box">
         <input type="file" accept="image/png, image/jpeg, image/jpg" name="product_image" class="box">
         <input type="submit" class="btn" name="add_product" value="add product"><span><button onclick="clos()" class="btn btnclose">close</button></span>
      </form>

   </div>
   <?php

if(isset($message)){
   foreach($message as $message){
      echo '<span class="message">'.$message.'</span>';
   }
}

?>
   <div class="nav">
      <input type="checkbox" name="checkbox" id="check" class="ch" />
      <label for="check" class="labl" id="menu" onclick="togglemenu()"><i class="fa-solid fa-bars"></i></label>
   </div>
   <div class="parent">
   <div class="container1" id="container1">

      <div class="admin-product-form-container" id="sidebar">

         <button class="btn" onclick="showcata()">Add Category</button>
         <button class="btn" onclick="showproduct()">Add Items</button>
         <div class="parentbtn">
            <button class="btn" onclick="showcatagory()">Category List</button>
            <button class="btn" onclick="showitems()">Items List</button>
            <button class="btn" onclick="showorders()">Orders List</button>
         </div>

      </div>
   </div>
      <?php

      $select = mysqli_query($conn, "SELECT * FROM products");
      
      ?>
      <div class="product-display products_table" id="product_table">
         <table class="product-display-table">
            <thead>
               <tr>
                  <th>product image</th>
                  <th>product name</th>
                  <th>product price</th>
                  <th>category</th>
                  <th>action</th>
               </tr>
            </thead>
            <?php while($row = mysqli_fetch_assoc($select)){ ?>
            <tr>
               <td><img src="uploaded_img/<?php echo $row['image']; ?>" height="100" alt=""></td>
               <td>
                  <?php echo $row['name']; ?>
               </td>
               <td>
                  <?php echo $row['price']; ?>/-
               </td>
               <td>
                  <?php echo $row['catagory']; ?>
               </td>
               <td>
                  <a href="admin_update.php?edit=<?php echo $row['id']; ?>" class="btn"> <i class="fas fa-edit"></i>
                     edit </a>
                  <a href="admin_page.php?delete=<?php echo $row['id']; ?>" class="btn"> <i class="fas fa-trash"></i>
                     delete </a>
               </td>
            </tr>
            <?php } ?>
         </table>

      </div>

      <!-- catagory tabel -->



      <?php

$select = mysqli_query($conn, "SELECT * FROM category");

?>
      <div class="product-display catagory_table" id="catagory_table">
         <table class="product-display-table">
            <thead>
               <tr>
                  <th>catagory image</th>
                  <th>catagory name</th>
                  <th>category discription</th>
                  <th>action</th>
               </tr>
            </thead>
            <?php while($row = mysqli_fetch_assoc($select)){ ?>
            <tr>
               <td><img src="uploaded_img/<?php echo $row['image']; ?>" height="100" alt=""></td>
               <td>
                  <?php echo $row['name']; ?>
               </td>
               <td>
                  <?php echo $row['discription']; ?>
               </td>
               <td>
                  <a href="C_admin_update.php?edit=<?php echo $row['id']; ?>" class="btn"> <i class="fas fa-edit"></i>
                     edit </a>
                  <a href="C_admin_page.php?delete=<?php echo $row['id']; ?>" class="btn"> <i class="fas fa-trash"></i>
                     delete </a>
               </td>
            </tr>
            <?php } ?>
         </table>
      </div>




      <?php

      $select = mysqli_query($conn, "SELECT * FROM ordercheck");
      
      ?>
      <div class="product-display products_table" id="order_table">
         <table class="product-display-table">
            <thead>
               <tr>

                  <th>Order Number</th>
                  <th>User Name</th>
                  <th>Phone Number</th>
                  <th>Order Details</th>
                  <th>Total Price</th>
               </tr>
               <!-- <tr>
               <td>Name</td>
               <td>Quantity</td>
               <td>Price</td>
            </tr>     -->
            </thead>
            <tbody>

               <?php while($row = mysqli_fetch_assoc($select)){ ?>
               <tr>

                  <td>
                     <?php echo $row['ordernumber']; ?>
                  </td>
                  <td>
                     <?php echo $row['username']; ?>
                  </td>
                  <td>
                     <?php echo $row['phonenumber']; ?>
                  </td>

                  <td style="font-size: 14px; font-weight: bold;">
                     <?php echo $row['orderdetail']; ?>
                  </td>

                  <td>
                     <?php echo $row['totalprice']; ?>
                  </td>

               </tr>
               <?php } ?>

            </tbody>

         </table>

      </div>



   </div>
   


      <script>
         pform = document.getElementById('productform');
         product_table = document.getElementById('product_table');
         catagory_table = document.getElementById('catagory_table');
         cform = document.getElementById('categoryform');
         order_table = document.getElementById('order_table')
         function showcata() {
            cform.style.display = "block";
            cform.classList.add("index");
         }
         function cloz() {
            cform.style.display = "none";
         }
         function showproduct() {
            pform.style.display = "block";
            pform.classList.add("index");
         }
         function clos() {
            pform.style.display = "none";
         }
         function showcatagory() {
            catagory_table.classList.toggle("toggle");
            product_table.classList.remove("toggle");
            order_table.classList.remove("toggle");
         }
         function showitems() {
            product_table.classList.toggle("toggle");
            catagory_table.classList.remove("toggle");
            order_table.classList.remove("toggle");

         }

         function showorders() {
            order_table.classList.toggle("toggle");
            catagory_table.classList.remove("toggle");
            product_table.classList.remove("toggle");

         }
         function togglemenu() {
            document.getElementById("sidebar").classList.toggle("togg");

            document.getElementById("container1").classList.toggle("toggg");
            document.getElementById("container1").style.width ="0px !important";
            product_table.style.width = "100%";
            catagory_table.style.width = "100%";
            order_table.style.width = "100%";
         }


         const myTimeout = setTimeout(magic, 10);

         function magic() {
            catagory_table.classList.add("toggle");


         }

      </script>

</body>

</html>