<?php
// Database configuration
$servername = "localhost";
$username = "root"; // change to your MySQL username
$password = ""; // change to your MySQL password
$dbname = "student_info";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get form data
$name = isset($_POST['name']) ? $_POST['name'] : '';
$age = isset($_POST['age']) ? $_POST['age'] : '';
$class = isset($_POST['class']) ? $_POST['class'] : '';
$gender = isset($_POST['gender']) ? $_POST['gender'] : '';
$address = isset($_POST['address']) ? $_POST['address'] : '';
$contact = isset($_POST['contact']) ? $_POST['contact'] : '';
$course = isset($_POST['course']) ? $_POST['course'] : '';
// Prepare and bind
$sql = "INSERT INTO studentform (name, age, class, gender, address, contact, course) VALUES (?, ?, ?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);

if ($stmt === false) {
    die("Error preparing statement: " . $conn->error);
}

$stmt->bind_param("sisssss", $name, $age, $class, $gender, $address, $contact, $course);

// Execute the statement
if ($stmt->execute()) {
    echo "New record created successfully";
} else {
    echo "Error: " . $stmt->error;
}

// Close connections
$stmt->close();
$conn->close();
?>