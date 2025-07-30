<?php
// Database connection
$host = "localhost";
$username = "root";  // Change if needed
$password = "";
$database = "reg";  // Replace with actual DB name

$conn = new mysqli($host, $username, $password, $database);
session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:admin_login.php');
}

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Default query
$sql = "SELECT id, name, price, date, enrolled FROM admission ORDER BY `date` DESC";

// Filter by date or month
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!empty($_POST['date'])) {
        $date = $_POST['date'];
        $sql = "SELECT id, name, price, date, enrolled
                FROM admission
                WHERE `date` = '$date'
                ORDER BY `date` DESC";
    } elseif (!empty($_POST['filter_month'])) {
        $month = $_POST['filter_month'];
        $sql = "SELECT id, name, price, date, enrolled
                FROM admission
                WHERE DATE_FORMAT(`date`, '%Y-%m') = '$month'
                ORDER BY `date` DESC";
    } elseif (!empty($_POST['enrolled'])) {
        $subject = $_POST['enrolled'];
        $sql = "SELECT id, name, price, date, enrolled
                FROM admission
                WHERE `enrolled` = '$subject'
                ORDER BY `enrolled` DESC";
    } elseif (!empty($_POST['name'])) {
        $name = $_POST['name'];
        $sql = "SELECT id, name, price, date, enrolled
                FROM admission
                WHERE `name` = '$name'
                ORDER BY `name` DESC";
    }
}

$result = $conn->query($sql);
$total_sales = 0;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sales Report</title>
    <style>
        /* Global Styles */
        body {
            font-family: 'Arial', sans-serif;
            background-color:burlywood;
            margin: 0;
            padding: 0;
        }

        h2 {
            text-align: center;
            margin-top: 2rem;
            color: #343a40;
        }

        /* Form Styles */
        form {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(25rem, 1fr));
            gap: 1rem;
            justify-content:center;
            align-items:center;
            margin: auto;
            max-width: 900px;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            padding-top: 3rem;
            padding-left: 3rem;
            padding-right: 3rem;
            padding-bottom: 1rem;
        }

        form label {
            font-size: 1.2rem;
            color: #495057;
            margin-left:5rem;
            font-weight:400;
        }

        form input {
            padding: 8px;
            font-size: 14px;
            border: 1px solid black;
            border-radius: 4px;
            width: 18rem;
            margin-left:3rem;
        }

        form h1 button {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 4px;
            cursor: pointer;
            width:25rem;
            margin-left:14rem;
            font-size:1.2rem;
        }

        form button:hover {
            background-color: #0056b3;
        }

        /* Table Styles */
        table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
            background-color: #ffffff;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
            padding:3rem;
            font-size:1.3rem;
            margin-top:4rem;
        }

        th, td {
            padding: 12px;
            text-align: center;
            border: 1px solid #ddd;
        }

        th {
            background-color: #f1f1f1;
            color: #343a40;
        }

        td {
            color: #495057;
        }

        /* Total Sales Section */
        h3 {
            text-align: center;
            margin-top: 2rem;
            font-size: 1.2rem;
            color: #28a745;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            form {
                flex-direction: column;
                align-items: center;
            }

            form input, form button {
                width: 100%;
                max-width: 300px;
            }

            table {
                font-size: 14px;
            }

            th, td {
                padding: 10px;
            }

            h2 {
                font-size: 1.5rem;
            }
        }

        @media (max-width: 480px) {
            form input, form button {
                width: 100%;
                max-width: 250px;
            }

            h2 {
                font-size: 1.2rem;
            }
        }
    </style>
</head>
<body>

<h1 style="font-size:2.5rem ; font-style:italic;" align=center>Sales Report</h1>

<!-- Filter Form -->
<form method="POST">
    <label for="date">Filter by Day:</label>
    <input type="date" name="date">
    <label for="month">Filter by Month:</label>
    <input type="month" name="filter_month">
    <label for="text">Filter by Subject Name:</label> 
    <input type="text" name="enrolled">
    <label for="text">Filter by User Name:</label>
    <input type="text" name="name">
  <h1 align="center">  <button type="submit" >Apply Filter</button></h1>
</form>

<!-- Sales Table -->
<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>User Name</th>
            <th>Subject</th>
            <th>Price</th>
            <th>Date</th>
        </tr>
    </thead>
    <tbody>
        <?php
        if ($result->num_rows > 0) {
            $counter = 1; // Initialize counter
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>{$counter}</td> <!-- Display counter for ID -->
                        <td>{$row['name']}</td>
                        <td>{$row['enrolled']}</td>
                        <td>₹" . number_format($row['price'], 2) . "</td>
                        <td>{$row['date']}</td>
                    </tr>";
                $total_sales += $row['price'];
                $counter++; // Increment counter
            }
        } else {
            echo "<tr><td colspan='5' style='text-align: center;'>No sales found</td></tr>";
        }
        ?>
    </tbody>
</table>

<h1 style="font-size:2.4rem ; font-style:italic; color:green; margin-top:3rem" align=center>Total Sales: ₹<?php echo number_format($total_sales, 2); ?></h1>

</body>
</html>

<?php
$conn->close();
?>
