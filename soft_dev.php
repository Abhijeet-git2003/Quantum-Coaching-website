<?php
include 'connect.php';
include 'user_header.php';

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
};

if(isset($_POST['sub'])){

   if($user_id == ''){
      header('location:login.php');
   }else{
      $sid = $_POST['sid'];
      $sid = filter_var($sid, FILTER_SANITIZE_STRING);
      $name = $_POST['name'];
      $name = filter_var($name, FILTER_SANITIZE_STRING);
      $price = $_POST['price'];
      $price = filter_var($price, FILTER_SANITIZE_STRING);
      $image = $_POST['image'];
      $image = filter_var($image, FILTER_SANITIZE_STRING);
      $category = $_POST['category'];
      $category = filter_var($category, FILTER_SANITIZE_STRING);

         $insert_sub = $conn->prepare("INSERT INTO `sub`(user_id, sid, name, image , category , price) VALUES(?,?,?,?,?,?)");
         $insert_sub->execute([$user_id,$sid, $name, $image , $category , $price]);
         header('location:EXAddmission.php');
         
      }

   }



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    
<section class="show-products">
   <h1 align="center" class="h1">Software Development</h1>
   <div class="box-container">
      
      <?php
   $show_subjects = $conn->prepare("SELECT * FROM `subjects` where category='soft_dev' ");
   $show_subjects->execute();
   if($show_subjects->rowCount() > 0){
      while($fetch_subjects = $show_subjects->fetch(PDO::FETCH_ASSOC)){  
         ?>
<div class="box">
   <form action="" method="post">
<input type="hidden" name="sid" value="<?= $fetch_subjects['id']; ?>">
   <input type="hidden" name="name" value="<?= $fetch_subjects['name']; ?>">
   <input type="hidden" name="image" value="<?= $fetch_subjects['image']; ?>">
   <input type="hidden" name="category" value="<?= $fetch_subjects['category']; ?>">
   <input type="hidden" name="price" value="<?= $fetch_subjects['price']; ?>">
   <img src="<?= $fetch_subjects['image']; ?>" alt="">
   <div class="flex">
   <div class="name"><?= $fetch_subjects['name']; ?></div>

   <div class="price"><span>₹</span><?= $fetch_subjects['price']; ?><span>/-</span></div>
 </div>
 <div class="details"><h5 align="center"><?= $fetch_subjects['details']; ?><br>
</div>
<button class="Btn programs" submit="sub" name="sub">Enroll Now</button>
</form>

</div>
<?php
      }
   }else{
      echo '<p class="empty">no subjects added yet!</p>';
   }
?>

</div>
</section>
</body>
</html>
