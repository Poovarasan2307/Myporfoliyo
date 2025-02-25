<?php
// Database configuration
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "test";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $message = htmlspecialchars($_POST['message']);

    // Prepare and bind
    $stmt = $conn->prepare("INSERT INTO contacts (name, email, message) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $name, $email, $message);

    // Execute the statement
    if ($stmt->execute()) {
        echo "<script>
        alert('Record successfully inserted.');
        window.location.href = 'myone.html';
      </script>";
    } else {
      "<script>
                alert('Error: " . $stmt->error . "');
               window.location.href = 'myone.html';
              </script>";
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
}
?>
