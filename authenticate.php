<?php
require_once 'conf.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Prepare and execute a query to fetch user's hashed password
    $query = "SELECT id, password FROM users WHERE username = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->bind_result($user_id, $hashed_password);
    $stmt->fetch();
    $stmt->close();

    // Verify password and redirect accordingly
    if (password_verify($password, $hashed_password)) {
        session_start();
        $_SESSION['authenticated'] = true;
        $_SESSION['user_id'] = $user_id;
        header('Location: file_browser.php');
        exit();
    } else {
        header('Location: index.php');
        exit();
    }
}
?>
