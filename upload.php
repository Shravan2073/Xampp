<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['file'])) {
    $user_id = $_SESSION['user_id'];
    $file = $_FILES['file'];
    $filename = $file['name'];
    $filepath = 'files/' . $filename;

    if (move_uploaded_file($file['tmp_name'], $filepath)) {
        $query = $pdo->prepare("INSERT INTO files (user_id, filename) VALUES (:user_id, :filename)");
        $query->execute(['user_id' => $user_id, 'filename' => $filename]);
        header('Location: index.php');
        exit();
    } else {
        $error = "Failed to upload file.";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Upload File</title>
    <link rel="stylesheet" type="text/css" href="css/styles.css">
</head>
<body>
    <h1>Upload File</h1>
    <?php if (isset($error)): ?>
        <p><?php echo $error; ?></p>
    <?php endif; ?>
    <form method="post" enctype="multipart/form-data">
        <label for="file">Choose a file:</label>
        <input type="file" id="file" name="file">
        <button type="submit">Upload</button>
    </form>
</body>
</html>
