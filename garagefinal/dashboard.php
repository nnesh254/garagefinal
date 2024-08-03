// dashboard.php
<?php
session_start();

if (!isset($_SESSION["username"])) {
    header("Location: index.html");
    exit;
}

$username = $_SESSION["username"];

echo "Welcome, $username!";

$csrf_token = bin2hex(random_bytes(32));
$_SESSION["csrf_token"] = $csrf_token;

echo "<form action='logout.php' method='post'>";
echo "<input type='hidden' name='csrf_token' value='$csrf_token'>";
echo "<button type='submit'>Logout</button>";
echo "</form>";
?>