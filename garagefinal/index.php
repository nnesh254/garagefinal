<?php
include 'db.php';
?>

<!DOCTYPE html>
<html>
<head>
    <title>Garage Book</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>Garage Book</h1>
    <form action="signup.php" method="post">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>
        <button type="submit">Sign up</button>
    </form>
    <p>Already have an account? <a href="login.php">Log in</a></p>
</body>
</html>