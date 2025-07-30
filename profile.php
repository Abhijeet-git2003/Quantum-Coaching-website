<?php

include 'connect.php';
include 'user_header.php';


if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
   header('location:home.php');
};

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>profile</title>


   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <link rel="stylesheet" href="style.css">
   <style>
body{
  /* background: linear-gradient(to right, #f8cdda, rgb(109, 142, 204)); */
}

.user-details .user{
  width:30%;
  margin:0 auto;
  border:0.2rem solid black;
  padding:2rem;
  text-align:center;
  border-radius:8%;
  height:auto;
  margin-bottom: 2rem;
  background: rgba(255, 255, 255, 0.9);
}

.user-details .user img{
  width: 100%;
  height: 15rem;
  object-fit: contain;
  margin-bottom: 1rem;
}

.user-details .user p{
  font-size: 1.3rem;
  margin-top:-1rem;
  font-weight:500;
}

.user-details .user p span{
  color:black;
}

.user-details .user p i{
  color:grey;
}

.user-details .user .address{
  margin-top: -1rem;
}

.Btn{
    display: inline-block;
          padding: 10px 20px;
          color: #fff;
          border: none;
          border-radius: 5px;
          text-decoration: none;
          margin-top: -0.2rem;
          font-size: 1.2rem;
          width: 40%;
}

   </style>

</head>
<body>
   

<section class="user-details">
<h1 align="center" class="h1" style="font-size:2.5rem">Profile</h1>
   <div class="user">
      <?php
         $user = $conn->prepare("SELECT * FROM `users` where id=? ");
         $user->execute([$user_id]);
         if($user->rowCount() > 0){
            while($fetch_profile = $user->fetch(PDO::FETCH_ASSOC)){ 
         
      ?>
      <img src="<?= $fetch_profile['image'] ?>" alt="photo cheepka re!!!!">
      <p><i class="fas fa-user"></i><span><span> <?= $fetch_profile['name']; ?></span></span></p>
      <p><i class="fas fa-phone"></i><span> <?= $fetch_profile['number']; ?></span></p>
      <p><i class="fas fa-envelope"></i><span> <?= $fetch_profile['email']; ?></span></p>
      <p class="address"><i class="fas fa-map-marker-alt"></i><span> <?php if($fetch_profile['address'] == ''){echo 'please enter your address';}else{echo $fetch_profile['address'];} ?></span></p>
      <a href="update_profile.php" class="Btn">update info</a>
      <a href="user_logout.php" class="Btn" style="background-color:red">logout</a>
    </div>
   <?php }}?>

</section>



<script src="js/script.js"></script>

</body>
</html>