<?php
// db_connect.php
$servername = "localhost";
$username = "root"; // Change as needed
$password = ""; // Change as needed
$dbname = "read_and_bill"; // Change as needed

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>