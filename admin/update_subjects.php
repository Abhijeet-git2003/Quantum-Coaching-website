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

if(isset($_POST['update'])){

   $sid = $_POST['sid'];
   $sid = filter_var($sid, FILTER_SANITIZE_STRING);
   $name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_STRING);
   $price = $_POST['price'];
   $price = filter_var($price, FILTER_SANITIZE_STRING);
   $category = $_POST['category'];
   $category = filter_var($category, FILTER_SANITIZE_STRING);
   $details = $_POST['details'];
   $details = filter_var($details, FILTER_SANITIZE_STRING);

   $update_subject = $conn->prepare("UPDATE `subjects` SET name = ?, category = ?,details =?, price = ? WHERE id = ?");
   $update_subject->execute([$name, $category,$details, $price, $sid]);

   $message[] = 'subject updated!';

   $old_image = $_POST['old_image'];
   $image = $_FILES['image']['name'];
   $image = filter_var($image, FILTER_SANITIZE_STRING);
   $image_size = $_FILES['image']['size'];
   $image_tmp_name = $_FILES['image']['tmp_name'];
   $image_folder = ''.$image;

   if(!empty($image)){
      if($image_size > 2000000){
         $message[] = 'images size is too large!';
      }else{
         $update_image = $conn->prepare("UPDATE `subjects` SET image = ? WHERE id = ?");
         $update_image->execute([$image, $sid]);
         move_uploaded_file($image_tmp_name, $image_folder);
         unlink(''.$old_image);
         $message[] = 'image updated!';
      }
   }

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

   <h1 class="heading">update subject</h1>

   <?php
      $update_id = $_GET['update'];
      $show_subjects = $conn->prepare("SELECT * FROM `subjects` WHERE id = ?");
      $show_subjects->execute([$update_id]);
      if($show_subjects->rowCount() > 0){
         while($fetch_subjects = $show_subjects->fetch(PDO::FETCH_ASSOC)){  
   ?>
   <form action="" method="POST" enctype="multipart/form-data">
      <input type="hidden" name="sid" value="<?= $fetch_subjects['id']; ?>">
      <input type="hidden" name="old_image" value="<?= $fetch_subjects['image']; ?>">
      <img src="<?= $fetch_subjects['image']; ?>" alt="">
      <span>update name</span>
      <input type="text" required placeholder="enter subject name" name="name" maxlength="100" class="box" value="<?= $fetch_subjects['name']; ?>">
      <span>update price</span>
      <input type="number" min="0" max="9999999999" required placeholder="enter subject price" name="price" onkeypress="if(this.value.length == 10) return false;" class="box" value="<?= $fetch_subjects['price']; ?>">
      <span>update category</span>
      <select name="category" class="box" required>
      <option selected disabled value="<?= $fetch_subjects['category']; ?>"><?= $fetch_subjects['category']; ?></option>
        
         <option value="programming" >Programming</option>
         <option value="web_dev">Web Development</option>
         <option value="soft_dev">Software Development</option>
      </select>
      <span>update details</span>
      <input type="textarea" class="box"  value="<?= $fetch_subjects['details']; ?>" name="details">
      <span>update image</span>
      <input type="file" name="image" class="box" accept="image/jpg, image/jpeg, image/png, image/webp">
      <div class="flex-btn">
         <input type="submit" value="update" class="btn" name="update">
         <a href="subjects.php" class="option-btn">go back</a>
      </div>
   </form>
   <?php
         }
      }else{
         echo '<p class="empty">no subjects added yet!</p>';
      }
   ?>

</section>

<script src="../js/admin_script.js"></script>

</body>
</html>