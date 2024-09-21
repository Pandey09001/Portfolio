<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect data from form fields
    $name = $_POST['name'];
    $email = $_POST['email'];
    $mobile = $_POST['mobile'];
    $message = $_POST['message'];

    // Validate fields
    if (!empty($name) && !empty($email) && !empty($mobile) && !empty($message)) {
        // Connect to the database
        $conn = new mysqli('localhost', 'root', '', 'portfolio_contact');

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Prepare and bind
        $stmt = $conn->prepare("INSERT INTO contacts (name, email, mobile, message) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $name, $email, $mobile, $message);

        // Execute the query
        if ($stmt->execute()) {
            echo "New record created successfully";
        } else {
            echo "Error: " . $stmt->error;
        }

        // Close connections
        $stmt->close();
        $conn->close();
    } else {
        echo "All fields are required!";
    }
    
}

?>
