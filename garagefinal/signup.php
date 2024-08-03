<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];
    $confirm_password = $_POST["confirm_password"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];

    
    if ($password!= $confirm_password) {
        echo "Error: Passwords do not match";
    } else {
        
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        
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
}

$conn->close();
?>