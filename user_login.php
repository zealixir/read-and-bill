<?php
// login.php
session_start();

// Check if user is already logged in
if (isset($_SESSION['user_id'])) {
    // User is logged in, check if PIN exists
    include 'db_connect.php';
    $stmt = $conn->prepare("SELECT pin FROM users WHERE id = ?");
    $stmt->bind_param("i", $_SESSION['user_id']);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();
    
    if ($user && !empty($user['pin'])) {
        // PIN exists, redirect to pin-login
        header("Location: pin-login.php");
    } else {
        // No PIN, redirect to PIN registration
        header("Location: pin-login.php");
    }
    exit();
}

// Process login form
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include 'db_connect.php';
    
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    $stmt = $conn->prepare("SELECT user_id, username, password, pin FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows == 1) {
        echo "meada";
        $user = $result->fetch_assoc();
        // Verify password (use password_verify if using password_hash)
        // if (password_verify($password, $user['password'])) {
        if ($password == $user['password']) {
            // Password is correct, set session
            $_SESSION['user_id'] = $user['user_id'];
            $_SESSION['username'] = $user['username'];
            
            // Check if PIN exists
            if (!empty($user['pin'])) {
                header("Location: pin-login.php");
            } else {
                header("Location: pin-login.php?register=true"); 
            }
            exit();
        } else {
            $error = "Invalid username or password";
        }
    } else {
        $error = "Invalid username or password";
    }
    
    $stmt->close();
    $conn->close();
}
?>
