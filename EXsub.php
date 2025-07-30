<?php
include 'connect.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
};
?>
<html>
    <head>
    <style>
    * {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  font-family: 'Poppins', sans-serif;
}
body {
  height: auto;
  display: flex;
  justify-content: center;
  align-items: center;
  padding: 10px;
  background: linear-gradient(135deg, #71b7e6, #9b59b6);
}
 .container {
  max-width: 50%;
  width: 100%;
  background-color: #fff;
  padding: 25px 30px;
  border-radius: 5px;
  box-shadow: 0 5px 10px rgba(0, 0, 0, 0.15);
}

.container .vishay .subject {
   display: grid;
   grid-template-columns: repeat(auto-fit, 15rem);
   /* justify-content: center; */
   align-items: flex-start;
   margin-top: 1rem;
   margin-bottom: 1.5rem;
   border: 0.2rem solid black;
   border-radius: 15%;
   padding: 1rem;
   gap:4.8rem;
   width:100%;
}

.container .vishay .subject .image img{
    height:12rem;
    width: 130%;
    border-radius: 15%;
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

<form action="" method="post" class="container">
  <div class="vishay">
  <?php
      $show_sub = $conn->prepare("SELECT * FROM `sub` ");
      $show_sub->execute();
      if($show_sub->rowCount() > 0){
         while($fetch_subjects = $show_sub->fetch(PDO::FETCH_ASSOC)){  
   ?>
   <input type="hidden" name="enrolled" value="<?= $fetch_subjects['name']; ?>">
   <input type="hidden" name="category" value="<?= $fetch_subjects['category']; ?>">
   <input type="hidden" name="price" value="<?= $fetch_subjects['price']; ?>">
    <div class="title">Admission Form</div>
    <div class="subject">
      <div class="image"> <img src="<?= $fetch_subjects['image']; ?>" alt="Imagwaaa"> </div>
        <div id="name"> <?= $fetch_subjects['name']; ?> <br> <?= $fetch_subjects['category']; ?> </div>
    </div>

    <?php
         }}
    ?>
    </div>