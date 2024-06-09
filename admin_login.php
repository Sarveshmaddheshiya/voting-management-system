<?php
session_start();
$username = $_POST['username'];
$password = $_POST['password'];

if ($username == 'sarvesh' && $password == '7525814495') {
    $_SESSION['admin'] = true;
    header("Location: admin_panel.html");
} else {
    echo "Invalid username or password";
}
?>
