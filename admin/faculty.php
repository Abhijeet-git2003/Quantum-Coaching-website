<?php

$db_name = 'mysql:host=localhost;dbname=reg';
$user_name = 'root';
$user_password = '';

$conn = new PDO($db_name, $user_name, $user_password);

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:admin_login.php');
};

if(isset($_POST['add_faculty'])){

   $name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_STRING);
   $degree = $_POST['degree'];
   $degree = filter_var($degree, FILTER_SANITIZE_STRING);
   $skills = $_POST['skills'];
   $skills = filter_var($skills, FILTER_SANITIZE_STRING);
   $experience = $_POST['experience'];
   $experience = filter_var($experience, FILTER_SANITIZE_STRING);
   

   $image = $_FILES['image']['name'];
   $image = filter_var($image, FILTER_SANITIZE_STRING);
   $image_size = $_FILES['image']['size'];
   $image_tmp_name = $_FILES['image']['tmp_name'];
   $image_folder = ''.$image;

   $select_faculty = $conn->prepare("SELECT * FROM `faculty` WHERE name = ?");
   $select_faculty->execute([$name]);


         move_uploaded_file($image_tmp_name, $image_folder);

         $insert_faculty = $conn->prepare("INSERT INTO `faculty`(name, image , degree , skills,experience) VALUES(?,?,?,?,?)");
         $insert_faculty->execute([$name, $image, $degree, $skills ,$experience]);

         $message[] = 'new subject added!';
 
      }



if(isset($_GET['delete'])){

   $delete_id = $_GET['delete'];
   $delete_faculty_image = $conn->prepare("SELECT * FROM `faculty` WHERE id = ?");
   $delete_faculty_image->execute([$delete_id]);
   $fetch_delete_image = $delete_faculty_image->fetch(PDO::FETCH_ASSOC);
  
   $delete_faculty = $conn->prepare("DELETE FROM `faculty` WHERE id = ?");
   $delete_faculty->execute([$delete_id]);
   $delete_cart = $conn->prepare("DELETE FROM `faculty` WHERE id = ?");
   $delete_cart->execute([$delete_id]);
   header('location:faculty.php');

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>faculty</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="admin.css">
   <style>
   .fle{
      font-size:1.6rem;
      color:blue;
      text-align:center;
   }
   </style>

</head>
<body>

<?php include 'admin_header.php' ?>

<!-- add facultys section starts  -->

<section class="add-products">

   <form action="" method="POST" enctype="multipart/form-data">
      <h3>add faculty</h3>
      <input type="text" required placeholder="enter faculty name" name="name" maxlength="100" class="box">
      <input type="text" required placeholder="enter faculty degree" name="degree" class="box">
      <input type="text" required placeholder="enter faculty skills" name="skills" class="box">
       <input type="text" class="box"  required placeholder="enter experience faculty" name="experience">
      <input type="file" name="image" class="box" accept="image/jpg, image/jpeg, image/png, image/webp" required>
      <input type="submit" value="add_faculty" name="add_faculty" class="btn">
   </form>

</section>



<section class="show-products">

   <div class="box-container">

   <?php
      $show_facultys = $conn->prepare("SELECT * FROM `faculty`");
      $show_facultys->execute();
      if($show_facultys->rowCount() > 0){
         while($fetch_facultys = $show_facultys->fetch(PDO::FETCH_ASSOC)){  
   ?>
   <div class="box">
      <img src="<?= $fetch_facultys['image']; ?>" alt="">
      <div class="fle">
      <div class="name"><?= $fetch_facultys['name']; ?></div>
      <div class="category">Skills : <?= $fetch_facultys['skills']; ?></div>
      <div class="category"> Degree : <?= $fetch_facultys['degree']; ?></div>
    </div>
    <div class="name"><h5 align="center">Experience : <?= $fetch_facultys['experience']; ?></h5></div>
      <div class="flex-btn">

         <a href="faculty.php?delete=<?= $fetch_facultys['id']; ?>" class="delete-btn" onclick="return confirm('delete this faculty?');">delete</a>
      </div>
   </div>
   <?php
         }
      }else{
         echo '<p class="empty">no faculty added yet!</p>';
      }
   ?>

   </div>

</section>

<script src="../js/admin_script.js"></script>

</body>
</html>