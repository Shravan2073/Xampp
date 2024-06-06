<?php
session_start();
include '../db.php';

if (!isset($_SESSION['is_admin']) || !$_SESSION['is_admin']) {
    header('Location: ../index.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $file_id = $_POST['file_id'];
    $new_filename = $_POST['new_filename'];

    $query = $pdo->prepare("UPDATE files SET filename = :new_filename WHERE id = :file_id");
    $query->execute(['new_filename' => $new_filename, 'file_id' => $file_id]);

    header('Location: ../admin.php');
    exit();
}

$query = $pdo->prepare("SELECT * FROM files");
$query->execute();
$files = $query->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Modify File</title>
    <link rel="stylesheet" type="text/css" href="../css/styles.css">
</head>
<body>
    <h1>Modify File</h1>
    <form method="post">
        <label for="file_id">File:</label>
        <select id="file_id" name="file_id">
            <?php foreach ($files as $file): ?>
                <option value="<?php echo $file['id']; ?>"><?php echo $file['filename']; ?></option>
            <?php endforeach; ?>
        </select>
        <label for="new_filename">New Filename:</label>
        <input type="text" id="new_filename" name="new_filename">
        <button type="submit">Modify File</button>
    </form>
</body>
</html>
