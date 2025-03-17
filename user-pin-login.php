<?php
// pin-login.php
session_start();

// Redirect if not logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Initialize variables
$register_mode = isset($_GET['register']) && $_GET['register'] === 'true';
$error = "";

include 'db_connect.php';

// Handle PIN submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $pin = $_POST['pin'];
    
    if ($register_mode) {
        // Register new PIN
        $stmt = $conn->prepare("UPDATE users SET pin = ? WHERE user_id = ?");
        $stmt->bind_param("si", $pin, $_SESSION['user_id']);
        $stmt->execute();
        $stmt->close();
        
        // Redirect to index
        header("Location: index.php");
        exit();
    } else {
        // Verify PIN
        $stmt = $conn->prepare("SELECT user_id FROM users WHERE user_id = ? AND pin = ?");
        $stmt->bind_param("is", $_SESSION['user_id'], $pin);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows == 1) {
            // PIN is correct, set complete auth
            $_SESSION['pin_verified'] = true;
            header("Location: index.php");
            exit();
        } else {
            $error = "Incorrect PIN";
        }
        $stmt->close();
    }
}

// Check if PIN exists
if (!$register_mode) {
    $stmt = $conn->prepare("SELECT pin FROM users WHERE user_id = ?");
    $stmt->bind_param("i", $_SESSION['user_id']);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();
    
    if ($user && empty($user['pin'])) {
        // No PIN, switch to register mode
        $register_mode = true;
    }
    $stmt->close();
}

$conn->close();
?>