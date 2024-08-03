<?php

$db_host = 'localhost';
$db_username = 'your_username';
$db_password = 'your_password';
$db_name = 'GarageBook';


$conn = new mysqli($db_host, $db_username, $db_password, $db_name);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>