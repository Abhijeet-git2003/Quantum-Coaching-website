
<?php
if (isset($_POST['submit'])){
  $name = $_POST['name'];
  $contact = $_POST['contact'];
  $email = $_POST['email']; 
  $address = $_POST['address'];     

// Connecting to the Database
$host = 'localhost';
$user = 'root';
$password = '';
$database = 'akatinfo';

// Create a connection
$conn = mysqli_connect($host, $user, $password, $database);

  $sql = "INSERT INTO akatsuki(name,contact,email,address) VALUES ('$name','$contact','$email','$address')";
  mysqli_query($conn, $sql);
} 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet">
    <title>form</title>
    <style>
        
/* body {
  background-image: url('suki.jpg');
  background-size: cover;
  background-repeat: no-repeat;
  background-attachment: fixed;

} */
body {
  display: flex;
  justify-content: center;
  align-items: center;
  height: 100vh;
  margin: 0;
  background-image: url("ns.png");
  background-size: cover;
  overflow: hidden;
}

/* #myform {
  max-width: 900px;
   height:50%;
  background-color: rgba(255, 255, 255, 0.8);
  padding: 20px;
  border-radius: 5px;
  box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);
} */

.form-field {
  margin-bottom: 10px;
}

.form-button-group {
  margin-top: 20px;
}

.form-button {
  margin-right: 10px;
}


.form-container {
    margin-top: 20%;
    width: 400px;
    background-color: #f8f8f8;
    padding: 20px;
    border-radius: 5px;
    box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
    opacity: 1;
    margin-left: 34%;
  }
  
  .form-title {
    text-align: center;
    margin-bottom: 30px;
  }
  
  .form-field {
    margin-bottom: 20px;
  }
  
  .form-field label {
    display: block;
    margin-bottom: 5px;
  }
  
  .form-field input,
  .form-field textarea,
  .form-field select {
    width: 100%;
    padding: 5px;
    border-radius: 5px;
    border: 1px solid #ccc;
    font-size: 16px;
  }
  
  .form-button-group {
    text-align: center;
    margin-top: 30px;
  }
  
  .form-button {
    background-color: #4CAF50;
    color: white;
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-size: 16px;
    margin: 0 5px;
  }
  
  .form-button:hover {
    background-color: #45a049;
  }
  
  .form-button:active {
    background-color: #3e8e41;
  }
  
  .form{
    width: 1500px;
    height: 900px;
  }

  #name{
    margin-right: 2px;
  }





@keyframes fadeIn {
    0% { opacity: 0; }
    100% { opacity: 1; }
  }
  
  .form-container {
    animation: fadeIn 1s ease-in-out;
  }
        </style>
</head>
<body>
    <img class="bg">
    <div class="form">
    <form action="#" method="POST" id="myform" >
        <div class="form-container">
            <h1 class="form-title">Student Enrollment Form</h1>
          <div class="form-field">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required>
          </div>
          <div class="form-field">
            <label for="contact">Contact Number:</label>
            <input type="tel" id="contact" name="contact" required>
          </div>
          <div class="form-field">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
          </div>
          <div class="form-field">
            <label for="address">Address:</label>
            <textarea id="address" name="address" required></textarea>
          </div>
          <div class="form-button-group">
            <button type="submit" class="form-button" name="submit">Submit</button>
            <button type="reset" class="form-button">Reset</button>
            <!-- <button type="button" class="form-button">Buy Now</button> -->
          </div>
        </div>
      </form>
    </div>
</body>
</html>

