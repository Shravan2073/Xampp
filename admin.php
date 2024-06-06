<?php
session_start();
if (!isset($_SESSION['is_admin']) || !$_SESSION['is_admin']) {
    header('Location: index.php');
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Admin Panel</title>
    <link rel="stylesheet" type="text/css" href="css/styles.css">
</head>
<body>
    <h1>Admin Panel</h1>
    <ul>
        <li><a href="admin/add_user.php">Add User</a></li>
        <li><a href="admin/remove_user.php">Remove User</a></li>
        <li><a href="admin/modify_user.php">Modify User</a></li>
        <li><a href="admin/modify_file.php">Modify File</a></li>
    </ul>
    <a href="../index.php">Back to Home</a>
</body>
</html>
