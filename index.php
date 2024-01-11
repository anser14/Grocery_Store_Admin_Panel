


<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Category Admin Page</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">
   <style>
      
     
     form{
        background: #028e8a !important; 
         height: 350px;
         width: 300px;
         border-radius: 10px !important;
        
      }
      .box {
         width: 400px;
         height: 35px !important;
         
      
      }
      form{
      position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    box-shadow: 0 0 5px #028e8a;
      }
     

      
   </style>

</head>
<body>

<?php

if(isset($message)){
   foreach($message as $message){
      echo '<span class="message">'.$message.'</span>';
   }
}

?>
   


   <div class="admin-product-form-container" style="height: 100vh; width: 100%;">

      <form action="logincheck.php" method="POST" >
         <h3 style="color: white;">Grocery Admin </h3>
         <br>
         <input type="text" placeholder="User Name" name="username" class="box"><br>
         <input type="text" placeholder="Password" name="password" class="box"><br><br>
         <input type="submit" class="btn" name="submit" value="Login">
      </form>

   </div>






</body>
</html>