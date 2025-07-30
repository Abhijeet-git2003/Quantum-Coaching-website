<?php

if(isset($_POST['add_to_sub'])){

   if($user_id == ''){
      header('location:login.php');
   }else{
      
      $name = $_POST['name'];
      $name = filter_var($name, FILTER_SANITIZE_STRING);
      $price = $_POST['price'];
      $price = filter_var($price, FILTER_SANITIZE_STRING);
      $image = $_POST['image'];
      $image = filter_var($image, FILTER_SANITIZE_STRING);
      $category = $_POST['category'];
      $category = filter_var($category, FILTER_SANITIZE_STRING);

         $insert_sub = $conn->prepare("INSERT INTO `sub`(user_id, name, image , category , price) VALUES(?,?,?,?,?)");
         $insert_sub->execute([$user_id, $name, $image , $category , $price]);
         header('location:EXAddmission.php');
         
      }

   }

?>