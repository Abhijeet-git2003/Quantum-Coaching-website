<?php 
include 'connect.php';
session_start();
if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
};
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
  *{
    padding: 0%;
    margin: 0%;
  }


   #uh{
  background-color:#333;
  color: #fff;
  padding: 15px;
  top: 0;
  right: 0;
  position: sticky;
  z-index: 1000;
  height: auto;
}

#user_head{
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding-left: 2rem;
    padding-right: 2rem;
    list-style: none;
   }

 #uh #user_head li a{
    color: #fff;
    font-size: 1.7rem;
    text-decoration: none;
    /* font-style: italic; */
    font-weight:700;
  }


    </style>
</head>
<body>
    <div id="uh">
      <ul id="user_head">
        <li><a href="home.php">🏠</a></li>
        <li><a href="">Quantam Coaching</a></li>
        <?php
        $select_profile = $conn->prepare("SELECT * FROM `users` WHERE id = ?");
        $select_profile->execute([$user_id]);
        if($select_profile->rowCount() > 0){
           $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
     ?>
        <li><a href="profile.php" id="profile">👤<?= $fetch_profile['name']; ?></a></li>

         <?php
            }else{
         ?>
         <li>   <a href="login.php">login</a></li>
  
      <?php } ?>
      </ul>
            </div>
</body>
</html>