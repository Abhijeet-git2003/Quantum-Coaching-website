<?php
include 'connect.php';
include 'user_header.php';



if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
};

if(isset($_POST['submit'])){

  $Stu_name = $_POST['Stu_name'];
  $Stu_name = filter_var($Stu_name, FILTER_SANITIZE_STRING);
  $user_img = $_POST['user_img'];
  $user_img = filter_var($user_img, FILTER_SANITIZE_STRING);
  $email = $_POST['email'];
  $email = filter_var($email, FILTER_SANITIZE_STRING);
  $number = $_POST['number'];
  $number = filter_var($number, FILTER_SANITIZE_STRING);
  $qualification = $_POST['qualification'];
  $qualification = filter_var($qualification, FILTER_SANITIZE_STRING);
  $address = $_POST['address'];
  $address = filter_var($address, FILTER_SANITIZE_STRING);
  $batch = $_POST['batch'];
  $batch = filter_var($batch, FILTER_SANITIZE_STRING);
  $gender = $_POST['gender'];
  $gender = filter_var($gender, FILTER_SANITIZE_STRING);
  

  $enrolled = $_POST['enrolled'];
  $enrolled = filter_var($enrolled, FILTER_SANITIZE_STRING);
  $category = $_POST['category'];
  $category = filter_var($category, FILTER_SANITIZE_STRING);
  $price = $_POST['price'];
  $price = filter_var($price, FILTER_SANITIZE_STRING);

  // if(empty($user_img)) {
  //     echo '<script>alert("Please upload your profile image."); window.location.href="update_profile.php";</script>';
  //     exit;
  // }
  
  $insert_addmission = $conn->prepare("INSERT INTO `admission`(user_id, user_img, name , email, number, qualification, address, batch, gender, enrolled, category, price) VALUES(?,?,?,?,?,?,?,?,?,?,?,?)");

  $insert_addmission->execute([$user_id,$user_img, $Stu_name, $email , $number , $qualification , $address , $batch , $gender , $enrolled , $category , $price]);

  // $delete_sub = $conn->prepare("DELETE FROM `sub` WHERE user_id = ?");
  // $delete_sub->execute([$user_id]);

  header('location:checkout.php');

  echo '
  <div class="message">
     <span>Enrolled Succesfully!!!</span>
     <i class="cross" onclick="this.parentElement.remove();"> ❌ </i>
  </div>
  ';




}

?>



<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title> Responsive Registration Form | CodingLab </title>
  <!-- <link rel="stylesheet" href="style.css"> -->
   <style>
    * {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  font-family: 'Poppins', sans-serif;
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
  height: 2rem;
}

.message span{
  font-size: 1.5rem;
  color:black;
}

.message .cross{
  font-size: 2rem;
  color:red;
  cursor: pointer;
}

.message .cross:hover{
  color:black;
}

.euu {
  height: auto;
  display: flex;
  justify-content: center;
  align-items: center;
  padding: 10px;
  /* background: linear-gradient(135deg, #71b7e6, #9b59b6); */
}
 .container {
  max-width: 50%;
  width: 100%;
  background-color: #fff;
  padding: 25px 30px;
  border-radius: 5px;
  box-shadow: 0 5px 10px rgba(0, 0, 0, 0.9);
}
.container .title {
  font-size: 25px;
  font-weight: 500;
  position: relative;
}
.container .title::before {
  content: "";
  position: absolute;
  left: 0;
  bottom: 0;
  height: 3px;
  width: 30px;
  border-radius: 5px;
  /* background: linear-gradient(135deg, #71b7e6, #9b59b6); */
}
.content .user-details {
    display: grid;
   grid-template-columns: repeat(auto-fit, 19rem);
   gap:1.2rem;
   justify-content: center;
   align-items: flex-start;
  margin: 20px 0 12px 0;
  /* margin-top: -4rem; */
}
form .user-details .input-box {
  margin-bottom: 15px;
  width: 92%;
}
form .input-box span.details {
  display: block;
  font-weight: 700;
  margin-bottom: 5px;
}
.user-details .input-box input {
  height: 45px;
  width: 100%;
  outline: none;
  font-size: 16px;
  border-radius: 5px;
  padding-left: 15px;
  border: 1px solid #ccc;
  border-bottom-width: 2px;
  transition: all 0.3s ease;
}
.user-details .input-box input:focus,
.user-details .input-box input:valid {
  border-color: #9b59b6;
}
form .gender-details .gender-title {
  font-size: 1.3rem;
  font-weight: 500;
}
form .category {
    display: grid;
   grid-template-columns: repeat(auto-fit, 15rem);
   gap:1.2rem;
   justify-content: center;
   align-items: flex-start;
   padding-top: 1rem;
}
form .category label {
  display: flex;
  align-items: center;
  cursor: pointer;
}
form .category label .dot {
  height: 18px;
  width: 18px;
  border-radius: 50%;
  margin-right: 10px;
  background: #d9d9d9;
  border: 5px solid transparent;
  transition: all 0.3s ease;
}
#dot-1:checked~.category label .one,
#dot-2:checked~.category label .two,
#dot-3:checked~.category label .three,
#dot-4:checked~.category label .four,
#dot-5:checked~.category label .five {
  background: #9b59b6;
  border-color: #d9d9d9;
}
form input[type="radio"] {
  display: none;
}
form .button {
  height: 45px;
  margin: 35px 0
}
form .button input {
  height: 100%;
  width: 100%;
  border-radius: 5px;
  border: none;
  color: #fff;
  font-size: 18px;
  font-weight: 500;
  letter-spacing: 1px;
  cursor: pointer;
  transition: all 0.3s ease;
  background: linear-gradient(135deg, #71b7e6, #9b59b6);
}
form .button input:hover {
  background: linear-gradient(-135deg, #71b7e6, #9b59b6);
}

.gender-details{
    margin-top: 1.8rem;
}

#address{
    height: 6rem;
    width: 215%;
}

.container .vishay .subject {
   display: grid;
   grid-template-columns: repeat(auto-fit, 15rem);
   /* justify-content: center; */
   align-items: flex-start;
   margin-top: 1rem;
   margin-bottom: 1.5rem;
   border: 0.2rem solid black;
   border-radius: 5%;
   padding: 1rem;
   gap:4.8rem;
   width:100%;
}

.container .vishay .subject .image img{
    height:12rem;
    width: 130%;
    border-radius: 10%;
    /* object-fit: contain; */
}

.container .vishay .subject #name{
    height:12rem;
    width: 120%;
    display: flex;
    justify-content: center;
    text-align: center;
    font-size: 1.5rem;
    font-style: italic;
    padding-top: 3.2rem;
}

   </style>
</head>
<body>
  <div class="euu">
  <form action="" method="post" class="container">
  <div class="vishay">
  <?php
      $show_sub = $conn->prepare("SELECT * FROM `sub` where user_id=? ORDER BY id DESC LIMIT 1");
      $show_sub->execute([$user_id]);
      if($show_sub->rowCount() > 0){
         while($fetch_subjects = $show_sub->fetch(PDO::FETCH_ASSOC)){  
   ?>
   <input type="hidden" name="enrolled" value="<?= $fetch_subjects['name']; ?>">
   <input type="hidden" name="category" value="<?= $fetch_subjects['category']; ?>">
   <input type="hidden" name="price" value="<?= $fetch_subjects['price']; ?>">
    <div class="title">Admission Form</div>
    <div class="subject">
      <div class="image"> <img src="<?= $fetch_subjects['image']; ?>" alt="Imagwaaa"> </div>
        <div id="name"> <?= $fetch_subjects['name']; ?> <br> <?= $fetch_subjects['category']; ?> <br> ₹ <?= $fetch_subjects['price']; ?> </div>
    </div>

    <?php
         }}
    ?>
    </div>
    <div class="content">

        <div class="user-details">
        <?php
         $user = $conn->prepare("SELECT * FROM `users` where id=? ");
         $user->execute([$user_id]);
         if($user->rowCount() > 0){
            while($fetch_profile = $user->fetch(PDO::FETCH_ASSOC)){ 
         
      ?>
          <input type="hidden" name="user_img" value="<?= $fetch_profile['image']; ?>">
          <div class="input-box">
            <span class="details">Full Name</span>
            <input type="text" name="Stu_name" placeholder="Enter your name" value="<?= $fetch_profile['name']; ?>" required>
          </div>

          <div class="input-box">
            <span class="details">Email</span>
            <input type="text" name="email" placeholder="Enter your email" value="<?= $fetch_profile['email']; ?>" required>
          </div>
 
          <div class="input-box">
            <span class="details">Phone Number</span>
            <input type="text" name="number" placeholder="Enter your number" value="<?= $fetch_profile['number']; ?>"  required>
          </div>

          <div class="input-box">
            <span class="details">Qualification</span>
            <input type="text" name="qualification" placeholder="Enter your qualification" required>
          </div>

          <div class="input-box">
            <span class="details">Address</span>
            <input type="textarea" name="address" id="address" placeholder="Enter your address" value="<?= $fetch_profile['address']; ?>"  required>
          </div>
          <?php
            }}
          ?>

        </div>
         
        <div class="gender-details">

            <input type="radio" name="batch" id="dot-1" value="Morning Batch">
            <input type="radio" name="batch" id="dot-2" value="Evening Batch">
            <span class="gender-title">Preferable Batch</span>
            <div class="category">

              <label for="dot-1">
                <span class="dot one"></span>
                <span class="gender">Morning Batch</span>
              </label>

              <label for="dot-2">
                <span class="dot two"></span>
                <span class="gender">Evening Batch</span>
              </label>
            </div>
          </div>

        <div class="gender-details">
          <!-- Radio buttons for gender selection -->
          <input type="radio" name="gender" id="dot-3" value="Male">
          <input type="radio" name="gender" id="dot-4" value="Female">
          <input type="radio" name="gender" id="dot-5" value="Prefer not say">
          <span class="gender-title">Gender</span>
          <div class="category">
            <!-- Label for Male -->
            <label for="dot-3">
              <span class="dot three"></span>
              <span class="gender">Male</span>
            </label>
            <!-- Label for Female -->
            <label for="dot-4">
              <span class="dot four"></span>
              <span class="gender">Female</span>
            </label>
            <!-- Label for Prefer not to say -->
            <label for="dot-5">
              <span class="dot five"></span>
              <span class="gender">Prefer not to say</span>
            </label>
          </div>
        </div>
        <div class="button">
          <input type="submit" value="Submit" name="submit">
        </div>
      </div>
      </form>
          </div>
</body>
</html>
