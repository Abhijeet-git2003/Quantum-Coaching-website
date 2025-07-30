<?php

include 'connect.php';
include 'user_header.php';

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
   header('location:home.php');
};

if(isset($_POST['submit'])){
   $name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_STRING);
   $email = $_POST['email'];
   $email = filter_var($email, FILTER_SANITIZE_STRING);
   $number = $_POST['number'];
   $number = filter_var($number, FILTER_SANITIZE_STRING);
   $address = $_POST['address'];
   $address = filter_var($address, FILTER_SANITIZE_STRING);
   $image =  $_POST['image'];
   $image = filter_var($image, FILTER_SANITIZE_STRING);

   if(!empty($name)){
      $update_name = $conn->prepare("UPDATE `users` SET name = ? WHERE id = ?");
      $update_name->execute([$name, $user_id]);
   }

   if(!empty($email)){
      $select_email = $conn->prepare("SELECT * FROM `users` WHERE email = ?");
      $select_email->execute([$email]);
      if($select_email->rowCount() > 1){
         $message[] = 'email already taken!';
         echo '
         <div class="message">
         <span>email already taken!</span>
         <i class="cross" onclick="this.parentElement.remove();"> X </i>
         </div>
         ';
      }else{
         $update_email = $conn->prepare("UPDATE `users` SET email = ? WHERE id = ?");
         $update_email->execute([$email, $user_id]);
      }
   }

   if(!empty($number)){
      $select_number = $conn->prepare("SELECT * FROM `users` WHERE number = ?");
      $select_number->execute([$number]);
      if($select_number->rowCount() > 0){
         $message[] = 'number already taken!';
         echo '
         <div class="message">
         <span>number already taken!</span>
         <i class="cross" onclick="this.parentElement.remove();"> X </i>
         </div>
         ';
      }else{
         $update_number = $conn->prepare("UPDATE `users` SET number = ? WHERE id = ?");
         $update_number->execute([$number, $user_id]);
      }
   }

   $empty_pass = 'da39a3ee5e6b4b0d3255bfef95601890afd80709';
   $select_prev_pass = $conn->prepare("SELECT password FROM `users` WHERE id = ?");
   $select_prev_pass->execute([$user_id]);
   $fetch_prev_pass = $select_prev_pass->fetch(PDO::FETCH_ASSOC);
   $prev_pass = $fetch_prev_pass['password'];
   $old_pass = sha1($_POST['old_pass']);
   $old_pass = filter_var($old_pass, FILTER_SANITIZE_STRING);
   $new_pass = sha1($_POST['new_pass']);
   $new_pass = filter_var($new_pass, FILTER_SANITIZE_STRING);
   $confirm_pass = sha1($_POST['confirm_pass']);
   $confirm_pass = filter_var($confirm_pass, FILTER_SANITIZE_STRING);

   if($old_pass != $empty_pass){
      if($old_pass != $prev_pass){
         $message[] = 'old password not matched!';
         echo '
         <div class="message">
         <span>Succesfully Updated!</span>
         <i class="cross" onclick="this.parentElement.remove();"> X </i>
         </div>
         ';
      }elseif($new_pass != $confirm_pass){
         $message[] = 'confirm password not matched!';
         echo '
         <div class="message">
         <span>Confirmed password not matched!</span>
         <i class="cross" onclick="this.parentElement.remove();"> X </i>
         </div>
         ';
      }else{
         if($new_pass != $empty_pass){
            $update_pass = $conn->prepare("UPDATE `users` SET password = ? WHERE id = ?");
            $update_pass->execute([$confirm_pass, $user_id]);
            $message[] = 'password updated successfully!';
            echo '
            <div class="message">
            <span>passowrd updated!</span>
            <i class="cross" onclick="this.parentElement.remove();"> X </i>
            </div>
            ';
         }else{
            $message[] = 'please enter a new password!';
         }
      }
   }  

   if(!empty($address)){
      $update_add = $conn->prepare("UPDATE `users` SET address = ? WHERE id = ?");
      $update_add->execute([$address, $user_id]);
   }

   if(!empty($image)){
      $update_img = $conn->prepare("UPDATE `users` SET image = ? WHERE id = ?");
      $update_img->execute([$image, $user_id]);
      echo '
      <div class="message">
      <span>Image updated!</span>
      <i class="cross" onclick="this.parentElement.remove();"> X </i>
      </div>
      ';
   }}
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Update Profile</title>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
   <style>
      body {
         /* background: linear-gradient(to right, #f8cdda, rgb(109, 142, 204)); */
         font-family: 'Arial', sans-serif;
      }
      .message{
  position: sticky;
  top:0;
  max-width: 1600px;
  margin:0 auto;
  padding:2rem;
  display: flex;
  align-items: center;
  gap:1rem;
  justify-content: space-between;
  background-color: yellow;
  height: 0.7rem;
  margin-top:-2.2rem;
  cursor:pointer;
}

      .form-container {
         display: flex;
         max-width: 950px;
         margin: 50px auto;
         padding: 20px;
         background: rgba(255, 255, 255, 0.9);
         border-radius: 10px;
         box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
         margin-top:1rem
      }
      .image-section {
         flex: 1;
         padding-right: 20px;
      }
      .form-section {
         flex: 2;
         padding-left: 2rem; /* Added space between the two sections */
      }
      .form-container h1 {
         text-align: center;
         margin-bottom: 20px;
         color: #333;
         width: 100%;
      }
      .form-group {
         margin-bottom: 15px;
      }
      .form-group label {
         display: block;
         margin-bottom: 5px;
         font-weight: bold;
         color: #555;
      }
      .form-group input {
         width: 90%;
         padding: 10px;
         border: 1px solid #ccc;
         border-radius: 5px;
         margin-top:.2rem;
      }
      .form-group input[type="file"] {
         padding: 3px;
      }
      .form-group input[type="submit"] {
         background-color: blue;
         color: white;
         border: none;
         cursor: pointer;
         font-size: 16px;
      }
      .form-group input[type="submit"]:hover {
         background-color: darkblue;
      }
   </style>
</head>
<body>

<section class="form-container">
   <div class="image-section">
      <form action="" method="post">
      <?php
         $user = $conn->prepare("SELECT * FROM `users` WHERE id = ?");
         $user->execute([$user_id]);
         if($user->rowCount() > 0){
            while($fetch_profile = $user->fetch(PDO::FETCH_ASSOC)){  
      ?>
      <div class="form-group">
         <input type="hidden" name="old_image" value="<?= $fetch_profile['image']; ?>">
         <img class="update_img" style="height: 25rem; width: 100%; object-fit: contain; padding-top: 4rem;" src="<?= $fetch_profile['image']; ?>" alt="Upload your image">
         <input type="file" name="image" accept="image/jpg, image/jpeg, image/png, image/webp">
      </div>
      <?php }}?>
   </div>
   <div class="form-section">
      <h1>Update Profile</h1>
      <?php
         $user = $conn->prepare("SELECT * FROM `users` WHERE id = ?");
         $user->execute([$user_id]);
         if($user->rowCount() > 0){
            while($fetch_profile = $user->fetch(PDO::FETCH_ASSOC)){  
      ?>
      <div class="form-group">
         <label for="name">Name:</label>
         <input type="text" id="name" name="name" placeholder="<?= $fetch_profile['name']; ?>" maxlength="50">
      </div>
      <div class="form-group">
         <label for="email">Email:</label>
         <input type="email" id="email" name="email" placeholder="<?= $fetch_profile['email']; ?>" maxlength="50" oninput="this.value = this.value.replace(/\s/g, '')">
      </div>
      <div class="form-group">
         <label for="number">Phone Number:</label>
         <input type="number" id="number" name="number" placeholder="<?= $fetch_profile['number']; ?>" min="0" max="9999999999" maxlength="10">
      </div>
      <div class="form-group">
         <label for="new_pass">New Password:</label>
         <input type="password" id="new_pass" name="new_pass" placeholder="Enter your new password" maxlength="50" oninput="this.value = this.value.replace(/\s/g, '')">
      </div>
      <div class="form-group">
         <label for="confirm_pass">Confirm New Password:</label>
         <input type="password" id="confirm_pass" name="confirm_pass" placeholder="Confirm your new password" maxlength="50" oninput="this.value = this.value.replace(/\s/g, '')">
      </div>
      <div class="form-group">
         <label for="address">Address:</label>
         <input type="text" id="address" name="address" placeholder="<?= $fetch_profile['address']; ?>" maxlength="500">
      </div>
      <div class="form-group">
         <input type="submit" value="Update Now" name="submit">
      </div>
      <?php }}?>
      </form>
   </div>
</section>

<script src="js/script.js"></script>
</body>
</html>
