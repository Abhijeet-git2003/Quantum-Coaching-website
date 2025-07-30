<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "reg";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Form submission handling
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $gender = $_POST['gender'];
    $age = $_POST['age'];
    $date_of_birth = $_POST['date_of_birth'];
    $email = $_POST['email'];
    $phone_number = $_POST['phone_number'];
    $address = $_POST['address'];
    $state = $_POST['state'];
    $pin_code = $_POST['pin_code'];
    $batch = $_POST['batch'];

    // Insert data into the database
    $sql = "INSERT INTO reginfo (first_name, last_name, gender, age, date_of_birth, email, phone_number, address, state, pin_code, batch)
            VALUES ('$first_name', '$last_name', '$gender', '$age', '$date_of_birth', '$email', '$phone_number', '$address', '$state', '$pin_code', '$batch')";

    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>








<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Student Registration Form</title>
  <link rel="stylesheet" href="admission.css">

</head>

<body>
  <div class="wrapper">
    <div class="title">admission form
    </div>
    <form action="#" method="post" id="myForm"> <!-- Added method="post" here -->
      <div class="form">
        <div class="inputfield">
          <label>First Name</label>
          <input type="text" class="input" name="first_name" placeholder="Enter first name" maxlength="30" pattern="[A-Za-z]{1,32}"
            required>
        </div>
        <!-- Similar changes for other input fields -->
        <div class="inputfield">
          <label>Last Name</label>
          <input type="text" class="input" name="last_name" placeholder="Enter last name" maxlength="30" pattern="[A-Za-z]{1,32}"
            required>
        </div>
        <!-- Other input fields with corresponding name attributes -->

        <div class="inputfield">
          <label for="">Gender</label>
          <input type="radio" name="gender" id="male" value="male" required><label for="male">Male</label>
          <input type="radio" name="gender" id="female" value="female" required><label for="female">Female</label>
        </div>



        <div class="inputfield">
          <label for="">Age</label>
          <input type="text" class="input" placeholder="Enter your age" maxlength="2" pattern="^[0-9]{2}$" required
            min="18" max="65" placeholder="Enter your age" name="age">
        </div>
        <div class="inputfield">
          <label for="">Date of Birth</label>
          <input type="date" class="input" required name="date_of_birth">
        </div>



        <div class="inputfield">
          <label>Email Address</label>
          <input type="email" class="input" placeholder="Enter your email"
            pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,63}$" required name="email">
        </div>
        <!-- <div class="inputfield">
          <label>Password</label>
          <input type="password" class="input" placeholder="Enter your password min 8 characters" maxlength="100"
            minlength="8" required pattern="^(?=.[A-Za-z])(?=.\d)[A-Za-z\d]{8,}$">
        </div>
        <div class="inputfield">
          <label>Confirm Password</label>
          <input type="password" class="input" placeholder="Enter your password min 8 characters" maxlength="100"
            minlength="8" required pattern="^(?=.[A-Za-z])(?=.\d)[A-Za-z\d]{8,}$">
        </div> -->

        <div class="inputfield">
          <label for="">Phone Number</label>
          <div class="custom-select" id="phone-codes">
            <select id="phone-code">
              <option value="+91">+91</option>
            </select>
          </div>
          <input type="number" class="input" maxlength="10" id="phone-number" placeholder="Enter your phone number"
            pattern="[7-9]{1}[0-9]{9}" title="Please enter valid phone number" name="phone_number">
        </div>
        <div class="inputfield">
          <label>Address</label>
          <textarea class="textarea" name="address" id="" cols="30" rows="5" placeholder="Enter your address"
            pattern="^[a-zA-Z][a-zA-Z0-9-_.]{5,12}$" maxlength="100" required></textarea>
        </div>
        <div class="inputfield">
          <label>State</label>
          <div class="custom_select">
            <select id="country-state" name="state" required>
              <option value="">--Select your state--</option>
              <option value="AN">Andaman and Nicobar Islands</option>
              <option value="AP">Andhra Pradesh</option>
              <option value="AR">Arunachal Pradesh</option>
              <option value="AS">Assam</option>
              <option value="BR">Bihar</option>
              <option value="CH">Chandigarh</option>
              <option value="CT">Chhattisgarh</option>
              <option value="DN">Dadra and Nagar Haveli</option>
              <option value="DD">Daman and Diu</option>
              <option value="DL">Delhi</option>
              <option value="GA">Goa</option>
              <option value="GJ">Gujarat</option>
              <option value="HR">Haryana</option>
              <option value="HP">Himachal Pradesh</option>
              <option value="JK">Jammu and Kashmir</option>
              <option value="JH">Jharkhand</option>
              <option value="KA">Karnataka</option>
              <option value="KL">Kerala</option>
              <option value="LA">Ladakh</option>
              <option value="LD">Lakshadweep</option>
              <option value="MP">Madhya Pradesh</option>
              <option value="MH">Maharashtra</option>
              <option value="MN">Manipur</option>
              <option value="ML">Meghalaya</option>
              <option value="MZ">Mizoram</option>
              <option value="NL">Nagaland</option>
              <option value="OR">Odisha</option>
              <option value="PY">Puducherry</option>
              <option value="PB">Punjab</option>
              <option value="RJ">Rajasthan</option>
              <option value="SK">Sikkim</option>
              <option value="TN">Tamil Nadu</option>
              <option value="TG">Telangana</option>
              <option value="TR">Tripura</option>
              <option value="UP">Uttar Pradesh</option>
              <option value="UT">Uttarakhand</option>
              <option value="WB">West Bengal</option>
            </select>
          </div>
        </div>
        <div class="inputfield">
          <label>Pin Code</label>
          <input type="text" class="input" placeholder="Enter your postal code" maxlength="6" pattern="^[0-9]{6}$"
            required name="pin_code">
        </div>

        <!-- Other input fields -->

        <div class="inputfield">
          <label for="">Select Your Batch</label> <br>
          <input type="radio" name="batch" id="morning" value="Morning Batch" required><label for="morning">Morning Batch</label>
          <input type="radio" name="batch" id="evening" value="Evening Batch" required><label for="evening">Evening Batch</label>
        </div>

        <!-- Removed other fields for brevity -->

        <div class="inputfield" id="btn">
        <a href="cart.html">  <button type="submit" value="Register" class="btn"  onclick="submitForm()"></a>
            <span style="color: aliceblue; text-decoration: none; width: 100%;">
            Submit
          
          </span>
          </button>
          <button type="reset" value="Reset" class="btn">Reset</button>
        </div>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
function submitForm() {
  $.ajax({
    url: "cart.html",
    type: "POST",
    data: $("#myForm").serialize(),
    success: function(response) {
      // Redirect the user to the cart.html page
      window.location = "cart.html";
    },
    error: function(xhr, status, error) {
      // Handle error here
      console.error("Error submitting form:", error);
    }
  });
}
</script>
      </div>
    </form>
  </div>

  <!-- <script>
    // Assuming you have a form with an input field for the email
const admissionForm = document.querySelector("#admission-form");

admissionForm.addEventListener("submit", function(event) {
  event.preventDefault(); // Prevent form submission
  
  // Get the email from the form input field
  const email = document.querySelector("#email").value;

  // Store the email in local storage
  localStorage.setItem("userEmail", email);

  // Redirect to the subject selection page
  window.location.href = "cart.html";
});
    </script> -->

</body>

</html>