<?php
$db_host = 'localhost';
$db_username = 'your_username';
$db_password = 'your_password';
$db_name = 'your_database';

$conn = new mysqli($db_host, $db_username, $db_password, $db_name);

if ($conn->connect_error) {
    die("Connection failed: ". $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];
    $confirm_password = $_POST["confirm_password"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];

    if (!preg_match('/^[a-zA-Z0-9_]+$/', $username)) {
        echo "Error: Invalid username";
        exit;
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Error: Invalid email";
        exit;
    }
    if ($password != $confirm_password) {
        echo "Error: Passwords do not match";
        exit;
    }

    $hashed_password = password_hash($password, PASSWORD_ARGON2ID);

    $sql = "INSERT INTO users (username, password, email, phone) VALUES (?,?,?,?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $username, $hashed_password, $email, $phone);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        echo "New record created successfully";
    } else {
        echo "Error: ". $sql. "<br>". $conn->error;
    }
}

$conn->close();
?>