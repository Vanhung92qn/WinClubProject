<?php
$servername = "10.40.112.5";
$username = "root";
$password = "0Db20H9CP6T4jRNBB70bVTrf5o7IG9";
$dbname = "vinplay_admin";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

echo "Connected successfully";

// Close connection
$conn->close();
?>
