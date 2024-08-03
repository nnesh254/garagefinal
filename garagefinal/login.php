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

   
    if (!preg_match('/^[a-zA-Z0-9_]+$/', $username)) {
        echo "Error: Invalid username";
        exit;
    }

    $sql = "SELECT * FROM users WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user_data = $result->fetch_assoc();
        if (password_verify($password, $user_data["password"])) {
            // Login successful, start session and redirect to dashboard
            session_start();
            $_SESSION["username"] = $username;
            header("Location: dashboard.php");
            exit;
        } else {
            echo "Error: Invalid password";
        }
    } else {
        echo "Error: User not found";
    }
}

$conn->close();
?>