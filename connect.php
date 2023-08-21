<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve the form data
    $name = $_POST["name"];
    $email = $_POST["email"];
    $gender = $_POST["gender"];
    $comments = $_POST["comments"];

    // Validate and process the data (you can customize this part)

    // Example: Simple validation for email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid email address.";
    } else {
        // Data is valid, you can process it further here
        
        // Include the database connection file (connect.php)
        include("connect.php");
        
        // Assuming you have a MySQL database connection
        // You would typically use prepared statements for security
        // Here, we'll just insert the data into a "users" table for demonstration
        $sql = "INSERT INTO users (name, email, gender, comments) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssss", $name, $email, $gender, $comments);
        
        if ($stmt->execute()) {
            echo "Data inserted successfully.";
        } else {
            echo "Error: " . $conn->error;
        }
        
        // Close the database connection
        $stmt->close();
        $conn->close();
    }
}
?>
