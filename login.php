<?php
session_start();

$admin_id = "sarvesh";
$admin_password = "7525814495";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $password = $_POST['password'];

    if ($id === $admin_id && $password === $admin_password) {
        $_SESSION['admin_logged_in'] = true;
        header("Location: admin.html");
        exit;
    } else {
        echo "Invalid credentials";
    }
}
?>
