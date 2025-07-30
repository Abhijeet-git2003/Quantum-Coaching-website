<?php
// Enable error reporting
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Start the session
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
  die("You must be logged in to access this page.");
}

// Get the user_id from the session
$user_id = $_SESSION['user_id'];

// Database connection using PDO
$servername = "localhost";
$username = "root"; // Replace with your database username
$password = ""; // Replace with your database password
$dbname = "reg"; // Replace with your database name

try {
  $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
  die("Connection failed: " . $e->getMessage());
}

// Fetch course details for the current user
$sql = "SELECT image, name, price FROM sub WHERE user_id = ? ORDER BY id DESC LIMIT 1";
$stmt = $conn->prepare($sql);
$stmt->execute([$user_id]);

// Debug: Check if data is fetched
if ($stmt->rowCount() > 0) {
  $row = $stmt->fetch(PDO::FETCH_ASSOC);
  $course_name = $row['name'];
  $course_image = $row['image']; // Assuming 'image' is used as description
  $course_price = $row['price'];
} else {
  $course_name = "Course Not Found";
  $course_image = "The requested course does not exist.";
  $course_price = "₹0.00";
}

if(isset($_POST['submit'])){
  // $payment = $_POST['payment-method'];
  // $payment = filter_var($payment, FILTER_SANITIZE_STRING);
  // $insert_payment = $conn->prepare("INSERT INTO `admission`(method) VALUES(?)");
  // $insert_payment->execute([$payment]);

  // $update_payment = $conn->prepare("UPDATE `admission` SET payment_status='paid' ");
  // $update_payment->execute([$user_id]);

  
  // $delete_sub = $conn->prepare("DELETE FROM `sub` WHERE user_id = ?");
  // $delete_sub->execute([$user_id]);

  header('location:home.php');
}

if(isset($_POST['sub'])){
  // $payment = $_POST['payment-method'];
  // $payment = filter_var($payment, FILTER_SANITIZE_STRING);
  // $insert_payment = $conn->prepare("INSERT INTO `admission`(method) VALUES(?)");
  // $insert_payment->execute([$payment]);

  // $update_payment = $conn->prepare("UPDATE `admission` where user_id=? SET payment_status='paid' ");
  // $update_payment->execute([$user_id]);

  
  // $delete_sub = $conn->prepare("DELETE FROM `sub` WHERE user_id = ?");
  // $delete_sub->execute([$user_id]);

  header('location:home.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Checkout Page</title>
  <style>
    /* General Styles */
    body {
      font-family: 'Arial', sans-serif;
      margin: 0;
      padding: 0;
      background: linear-gradient(135deg, #f9f9f9, #e0e0e0);
      color: #333;
      line-height: 1.6;
    }

    h1, h2 {
      color: #2d3e50;
      margin: 0 0 20px;
    }

    .checkout-container {
      max-width: 800px;
      margin: 50px auto;
      padding: 30px;
      background: #fff;
      border-radius: 12px;
      box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
    }

    .checkout-content {
      display: flex;
      flex-direction: column;
      gap: 25px;
    }

    .course-details {
      background: #f1f3f6;
      padding: 20px;
      border-radius: 8px;
      text-align: center;
    }

    .course-image img {
      max-width: 100%;
      height: auto;
      border-radius: 8px;
      margin-bottom: 15px;
    }

    .course-details h2 {
      font-size: 24px;
      margin: 10px 0;
    }

    .course-details p {
      font-size: 18px;
      color: #555;
    }

    .payment-options {
      display: flex;
      flex-direction: column;
      gap: 15px;
    }

    .payment-method {
      display: flex;
      align-items: center;
      gap: 10px;
      padding: 10px;
      background: #fff;
      border: 1px solid #ddd;
      border-radius: 8px;
      cursor: pointer;
      transition: all 0.3s ease;
    }

    .payment-method:hover {
      border-color: #2d3e50;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    }

    .payment-form {
      display: flex;
      flex-direction: column;
      gap: 20px;
    }

    .form-group {
      display: flex;
      flex-direction: column;
      gap: 8px;
    }

    .form-group label {
      font-weight: 600;
      color: #2d3e50;
    }

    .form-group input {
      padding: 12px;
      border: 1px solid #ccc;
      border-radius: 6px;
      font-size: 16px;
      transition: border-color 0.3s ease;
    }

    .form-group input:focus {
      border-color: #2d3e50;
      outline: none;
      box-shadow: 0 0 5px rgba(45, 62, 80, 0.2);
    }

    .upi-note {
      font-size: 14px;
      color: #666;
      margin-top: 10px;
    }

    .pay-button {
      background: linear-gradient(135deg, #2d3e50, #1a2a3a);
      color: #fff;
      padding: 14px;
      border: none;
      border-radius: 6px;
      font-size: 16px;
      font-weight: 600;
      cursor: pointer;
      transition: all 0.3s ease;
    }

    .pay-button:hover {
      background: linear-gradient(135deg, #1a2a3a, #2d3e50);
      transform: translateY(-2px);
    }

    /* Responsive Design */
    @media (max-width: 600px) {
      .checkout-container {
        margin: 20px;
        padding: 20px;
      }

      .course-details h2 {
        font-size: 20px;
      }

      .course-details p {
        font-size: 16px;
      }

      .form-group input {
        font-size: 14px;
      }
      
      .pay-button {
        font-size: 14px;
      }
    }
  </style>
</head>
<body>
  <div class="checkout-container">
    <h1>Checkout</h1>
    <div class="checkout-content">
      <!-- Course Details -->
      <div class="course-details">
        <div class="course-image">
          <img src="<?php echo htmlspecialchars($course_image); ?>" alt="<?php echo htmlspecialchars($course_name); ?>">
        </div>
        <h2><?php echo htmlspecialchars($course_name); ?></h2>
        <p><strong>Price:</strong> ₹ <?php echo htmlspecialchars($course_price); ?></p>
      </div>
      
      <!-- Payment Options -->
      <div class="payment-options">
        <h2>Choose Payment Method</h2>
        <form id="payment-form" class="payment-form" method="post">
        <div class="payment-method">
          <input type="radio" id="credit-card" name="payment-method" value="credit-card" checked>
          <label for="credit-card">Credit/Debit Card</label>
        </div>
        <div class="payment-method">
          <input type="radio" id="upi" name="payment-method" value="upi">
          <label for="upi">UPI (Paytm, PhonePe)</label>
        </div>
      </div>
      
      <!-- Payment Form -->
      <!-- Credit Card Form -->
      <div id="credit-card-form">
        <h2>Payment Information</h2>
        <div class="form-group">
            <label for="card-number">Card Number</label>
            <input type="text" id="card-number" placeholder="1234 5678 9012 3456" value="Credit-card" name="payment-method"  required>
          </div>
          <div class="form-group">
            <label for="expiry-date">Expiry Date</label>
            <input type="text" id="expiry-date" placeholder="MM/YY" required>
          </div>
          <div class="form-group">
            <label for="cvv">CVV</label>
            <input type="text" id="cvv" placeholder="123" required>
          </div>
          <!-- <button type="submit" class="pay-button" name="sub">Pay Now</button> -->
  </form>
        </div>
        
        <!-- UPI Form -->
        <div id="upi-form" style="display: none;">
        <form id="" class="payment-form" method="post">
          <h2>UPI Payment</h2>
          <div class="form-group">
            <label for="upi-id">UPI ID</label>
            <input type="text" id="upi-id" placeholder="yourname@upi" value="upi" name="payment-method" required>
          </div>
          <p class="upi-note">Use Paytm, PhonePe, or any UPI app to complete the payment.</p>
        </div>
        <button type="submit" class="pay-button" name="submit">Pay Now</button>

      </form>
    </div>
  </div>

  <script>
    // Toggle between Credit Card and UPI forms
    document.querySelectorAll('input[name="payment-method"]').forEach((input) => {
      input.addEventListener('change', function () {
        const creditCardForm = document.getElementById('credit-card-form');
        const upiForm = document.getElementById('upi-form');

        if (this.value === 'credit-card') {
          creditCardForm.style.display = 'block';
          upiForm.style.display = 'none';
        } else if (this.value === 'upi') {
          creditCardForm.style.display = 'none';
          upiForm.style.display = 'block';
        }
      });
    });

    // Handle form submission
    document.getElementById('payment-form').addEventListener('submit', function (e) {
      e.preventDefault();

      const paymentMethod = document.querySelector('input[name="payment-method"]:checked').value;

      if (paymentMethod === 'credit-card') {
        const cardNumber = document.getElementById('card-number').value;
        const expiryDate = document.getElementById('expiry-date').value;
        const cvv = document.getElementById('cvv').value;

        if (!cardNumber || !expiryDate || !cvv) {
          alert('Please fill in all fields for Credit Card payment.');
          return;
        }
      } else if (paymentMethod === 'upi') {
        const upiId = document.getElementById('upi-id').value;

        if (!upiId) {
          alert('Please enter your UPI ID.');
          return;
        }
      }

      // Simulate payment processing
      alert('Your payment process is successfully done.');
      window.location.href = 'home.php';

    });
  </script>
</body>
</html>
