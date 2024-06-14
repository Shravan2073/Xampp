<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

$user_id = $_SESSION['user_id'];
$query = $pdo->prepare("SELECT * FROM files WHERE user_id = :user_id");
$query->execute(['user_id' => $user_id]);
$files = $query->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html>
<head>
    <title>File Management</title>
    <link rel="stylesheet" type="text/css" href="css/styles.css">
</head>
<body>
    <h1>Welcome to File Management</h1>
    <a href="upload.php">Upload File</a> | <a href="logout.php">Logout</a>
    <h2>Your Files</h2>
    <ul>
        <?php foreach ($files as $file): ?>
            <li><?php echo htmlspecialchars($file['filename']); ?> - <a href="files/<?php echo htmlspecialchars($file['filename']); ?>">Download</a></li>
        <?php endforeach; ?>
    </ul>
    <?php if ($_SESSION['is_admin']): ?>
        <a href="admin.php">Admin Panel</a>
    <?php endif; ?>
</body>
</html>
