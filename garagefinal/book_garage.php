<?php
include 'db.php';
session_start();

if (!isset($_SESSION["username"])) {
    header("Location: login.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $garage_id = $_POST["garage_id"];
    $user_id = $_SESSION["username"];

    $query = "INSERT INTO Bookings (user_id, garage_id, booking_date, start_time, end_time, status) VALUES (?,?, NOW(), '09:00:00', '17:00:00', 'pending')";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ii", $user_id, $garage_id);
    $stmt->execute();

    header("Location: booking.php");
    exit;
}
?>