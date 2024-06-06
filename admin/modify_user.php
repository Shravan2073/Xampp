<?php
session_start();
include '../db.php';

if (!isset($_SESSION['is_admin']) || !$_SESSION['is_admin']) {
    header('Location: ../index.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $new_username = $_POST['new_username'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $is_admin = isset($_POST['is_admin']) ? 1 : 0;

    $query = $pdo->prepare("UPDATE users SET username = :new_username, password = :password, is_admin = :is_admin WHERE username = :username");
    $query->execute(['new_username' => $new_username, 'password' => $password, 'is_admin' => $is_admin, 'username' => $username]);

    header('Location: ../admin.php');
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Modify User</title>
    <link rel="stylesheet" type="text/css" href="../css/styles.css">
</head>
<body>
    <h1>Modify User</h1>
    <form method="post">
        <label for="username">Current Username:</label>
        <input type="text" id="username" name="username">
        <label for="new_username">New Username:</label>
        <input type="text" id="new_username" name="new_username">
        <label for="password">New Password:</label>
        <input type="password" id="password" name="password">
        <label for="is_admin">Admin:</label>
        <input type="checkbox" id="is_admin" name="is_admin">
        <button type="submit">Modify User</button>
    </form>
</body>
</html>
