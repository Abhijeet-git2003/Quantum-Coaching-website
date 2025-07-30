<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Retrieve the email, selected subjects, and total price from the form submission
        $userEmail = $_POST['email'];
        $selectedSubjects = json_decode($_POST['selected_subjects'], true);
        $totalPrice = $_POST['total_price'];

        // Process the data (store it in the database, etc.)
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "cart";
        

        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);
        
        $sql = "INSERT INTO subinfo(email,selected_subjects,total_price )
        VALUES (' $userEmail', '$selectedSubjects', '$totalPrice')";
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        echo "Connected successfully";
    }

    
    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    ?>