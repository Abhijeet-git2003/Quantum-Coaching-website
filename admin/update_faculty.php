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
 

 
          move_uploaded_file($image_tmp_name, $image_folder);
 
          $insert_faculty = $conn->prepare("UPDATE INTO `faculty`(name, image , degree , skills,experience) VALUES(?,?,?,?,?)");
          $insert_faculty->execute([$name, $image, $degree, $skills ,$experience]);
 
          $message[] = 'new subject added!';
          echo '
          <div class="message">
          <span>new faculty added!</span>
          <i class="cross" onclick="this.parentElement.remove();"> X </i>
          </div>
          ';
       }

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>update subject</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="admin.css">

</head>
<body>

<?php include 'admin_header.php' ?>

<section class="update-product">

   <h1 class="heading">Add faculty</h1>

   <?php
      $update_id = $_GET['update'];
      $show_subjects = $conn->prepare("SELECT * FROM `faculty` WHERE id = ?");
      $show_subjects->execute([$update_id]);
      if($show_subjects->rowCount() > 0){
         while($fetch_subjects = $show_subjects->fetch(PDO::FETCH_ASSOC)){  
   ?>
   <form action="" method="POST" enctype="multipart/form-data">
      <h3></h3>
      <input type="hidden" name="sid" value="<?= $fetch_subjects['id']; ?>">
      <input type="hidden" name="old_image" value="<?= $fetch_subjects['image']; ?>">
      <img src="<?= $fetch_subjects['image']; ?>" alt="">
      <input type="text" required placeholder="enter faculty name" name="name" maxlength="100" class="box" value="<?= $fetch_subjects['name']; ?>">
      <input type="text" required placeholder="enter faculty degree" name="degree" class="box" value="<?= $fetch_subjects['degree']; ?>">
      <input type="text" required placeholder="enter faculty skills" name="skills" class="box" value="<?= $fetch_subjects['skills']; ?>">
       <input type="text" class="box"  required placeholder="enter experience faculty" name="experience" value="<?= $fetch_subjects['experience']; ?>">
      <input type="file" name="image" class="box" accept="image/jpg, image/jpeg, image/png, image/webp" required>
      <input type="submit" value="add_faculty" name="add_faculty" class="btn">
   </form>
   <?php
         }
      }
   ?>

</section>

<script src="../js/admin_script.js"></script>

</body>
</html>