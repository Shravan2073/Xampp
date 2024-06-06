<?php
session_start();
include '../db.php';

if (!isset($_SESSION['is_admin']) || !$_SESSION['is_admin']) {
    header('Location: ../index.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];

    $query = $pdo->prepare("DELETE FROM users WHERE username = :username");
    $query->execute(['username' => $username]);

    header('Location: ../admin.php');
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Remove User</title>
    <link rel="stylesheet" type="text/css" href="../css/styles.css">
</head>
<body>
    <h1>Remove User</h1>
    <form method="post">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username">
        <button type="submit">Remove User</button>
    </form>
</body>
</html>
