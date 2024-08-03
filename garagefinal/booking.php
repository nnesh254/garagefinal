<?php
include 'db.php';
session_start();

if (!isset($_SESSION["username"])) {
    header("Location: login.php");
    exit;
}

$query = "SELECT * FROM Garages";
$result = $conn->query($query);

if ($result->num_rows > 0) {
    echo "<h1>Available Garages</h1>";
    echo "<ul>";
    while ($row = $result->fetch_assoc()) {
        echo "<li>$row[name] - $row[address] (Capacity: $row[capacity])</li>";
    }
    echo "</ul>";
    echo "<form action='book_garage.php' method='post'>";
    echo "<label for='garage_id'>Select a garage:</label>";
    echo "<select id='garage_id' name='garage_id'>";
    while ($row = $result->fetch_assoc()) {
        echo "<option value='$row[id]'>$row[name] - $row[address]</option>";
    }
    echo "</select>";
    echo "<button type='submit'>Book Garage</button>";
    echo "</form>";
} else {
    echo "<p>No garages available.</p>";
}
?>