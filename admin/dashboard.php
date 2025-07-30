<?php

$db_name = 'mysql:host=localhost;dbname=reg';
$user_name = 'root';
$user_password = '';

$conn = new PDO($db_name, $user_name, $user_password);

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:admin_login.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>dashboard</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="admin.css">

</head>
<body>

<?php include 'admin_header.php' ?>
<!-- admin dashboard section starts  -->

<section class="dashboard">

   <h1 class="heading">dashboard</h1>

   <div class="box-container">

   <div class="box">
      <h3>welcome!</h3>
      <?php
            $select_profile = $conn->prepare("SELECT * FROM `admin` WHERE id = ?");
            $select_profile->execute([$admin_id]);
            $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
         ?>
      <p><?php echo $fetch_profile['name']; ?></p>
      <a href="admin_profile.php" class="btn">update profile</a>
   </div>

   <div class="box">
   <?php
         $select_subjects = $conn->prepare("SELECT * FROM `subjects`");
         $select_subjects->execute();
         $numbers_of_subjects = $select_subjects->rowCount();
      ?>
    <h3>Subjects</h3>
      <p><?= $numbers_of_subjects; ?></p>
    <a href="subjects.php" class="btn">See Subjects</a>
   </div>

   <div class="box">
   <?php
         $select_faculty = $conn->prepare("SELECT * FROM `faculty`");
         $select_faculty->execute();
         $numbers_of_faculty = $select_faculty->rowCount();
      ?>
    <h3>Faculty</h3>
      <p><?= $numbers_of_faculty; ?></p>
    <a href="faculty.php" class="btn">See faculty</a>
   </div>

   
   <div class="box">
   <?php
         $select_faculty = $conn->prepare("SELECT * FROM `admission`");
         $select_faculty->execute();
         $numbers_of_faculty = $select_faculty->rowCount();
      ?>
    <h3>Report</h3>
      <p><?= $numbers_of_faculty; ?></p>
    <a href="report.php" class="btn">See report</a>
   </div>

   <div class="box">
      <?php
         $select_admins = $conn->prepare("SELECT * FROM `admin`");
         $select_admins->execute();
         $numbers_of_admins = $select_admins->rowCount();
      ?>
      <h3>Admin</h3>
      <p><?= $numbers_of_admins; ?></p>
      <a href="admin_accounts.php" class="btn">see admins</a>
   </div>

  
   </div>

</section>

<!-- admin dashboard section ends -->









<!-- custom js file link  -->
<script src="../js/admin_script.js"></script>

</body>
</html>