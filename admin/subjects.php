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

if(isset($_POST['add_subjects'])){

   $name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_STRING);
   $price = $_POST['price'];
   $price = filter_var($price, FILTER_SANITIZE_STRING);
   $category = $_POST['category'];
   $category = filter_var($category, FILTER_SANITIZE_STRING);
   $details = $_POST['details'];
   $details = filter_var($details, FILTER_SANITIZE_STRING);
   

   $image = $_FILES['image']['name'];
   $image = filter_var($image, FILTER_SANITIZE_STRING);
   $image_size = $_FILES['image']['size'];
   $image_tmp_name = $_FILES['image']['tmp_name'];
   $image_folder = ''.$image;

   $select_subjects = $conn->prepare("SELECT * FROM `subjects` WHERE name = ?");
   $select_subjects->execute([$name]);

   if($select_subjects->rowCount() > 0){
      $message[] = 'subject name already exists!';

   }else{
      if($image_size > 2000000){
         $message[] = 'image size is too large';

      }else{
         move_uploaded_file($image_tmp_name, $image_folder);

         $insert_subjects = $conn->prepare("INSERT INTO `subjects`(name, image , category , details,price) VALUES(?,?,?,?,?)");
         $insert_subjects->execute([$name, $image, $category, $details,$price]);

         $message[] = 'new subject added!';
  
      }

   }

}

if(isset($_GET['delete'])){

   $delete_id = $_GET['delete'];
   $delete_subject_image = $conn->prepare("SELECT * FROM `subjects` WHERE id = ?");
   $delete_subject_image->execute([$delete_id]);
   $fetch_delete_image = $delete_subject_image->fetch(PDO::FETCH_ASSOC);
  
   $delete_subject = $conn->prepare("DELETE FROM `subjects` WHERE id = ?");
   $delete_subject->execute([$delete_id]);
   $delete_cart = $conn->prepare("DELETE FROM `subjects` WHERE id = ?");
   $delete_cart->execute([$delete_id]);
   header('location:subjects.php');

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>subjects</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="admin.css">

</head>
<body>

<?php include 'admin_header.php' ?>

<!-- add subjects section starts  -->

<section class="add-products">

   <form action="" method="POST" enctype="multipart/form-data">
      <h3>add subject</h3>
      <input type="text" required placeholder="enter subject name" name="name" maxlength="100" class="box">
      <input type="number" min="0" max="9999999" required placeholder="enter subject price" name="price" onkeypress="if(this.value.length == 10) return false;" class="box">
      <select name="category" class="box" required>
         <option value="" disabled selected>select category --</option>
         <option value="programming" >Programming</option>
         <option value="web_dev">Web Development</option>
         <option value="soft_dev">Software Development</option>
      </select>
       <input type="textarea" class="box"  required placeholder="enter details of subject" name="details">
      <input type="file" name="image" class="box" accept="image/jpg, image/jpeg, image/png, image/webp" required>
      <input type="submit" value="add_subjects" name="add_subjects" class="btn">
   </form>

</section>



<section class="show-products">

   <div class="box-container">

   <?php
      $show_subjects = $conn->prepare("SELECT * FROM `subjects`");
      $show_subjects->execute();
      if($show_subjects->rowCount() > 0){
         while($fetch_subjects = $show_subjects->fetch(PDO::FETCH_ASSOC)){  
   ?>
   <div class="box">
      <img src="<?= $fetch_subjects['image']; ?>" alt="">
      <div class="flex">
      <div class="name"><?= $fetch_subjects['name']; ?></div>
      <div class="category">(<?= $fetch_subjects['category']; ?>)</div>
      <div class="price"><span>₹</span><?= $fetch_subjects['price']; ?><span>/-</span></div>
    </div>
    <div class="name"><h5 align="center"><?= $fetch_subjects['details']; ?></h5></div>
      <div class="flex-btn">
         <a href="update_subjects.php?update=<?= $fetch_subjects['id']; ?>" class="option-btn">update</a>
         <a href="subjects.php?delete=<?= $fetch_subjects['id']; ?>" class="delete-btn" onclick="return confirm('delete this subject?');">delete</a>
      </div>
   </div>
   <?php
         }
      }else{
         echo '<p class="empty">no subjects added yet!</p>';
      }
   ?>

   </div>

</section>

<script src="../js/admin_script.js"></script>

</body>
</html>