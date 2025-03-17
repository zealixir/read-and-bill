<?php
// index.php
session_start();

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Check if PIN is verified
if (!isset($_SESSION['pin_verified'])) {
    header("Location: pin-login.php");
    exit();
}

// Include database connection
include 'db_connect.php';

// Get user information
$stmt = $conn->prepare("SELECT name, username, role FROM users WHERE user_id = ?");
$stmt->bind_param("i", $_SESSION['user_id']);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
    <div class="container">
        <h1>Welcome, <?php echo htmlspecialchars($user['name']); ?></h1>
        <p>Username: <?php echo htmlspecialchars($user['username']); ?></p>
        <p>Role: <?php echo htmlspecialchars($user['role']); ?></p>
        
        <a href="logout.php">Logout</a>
    </div>
</body>
</html>