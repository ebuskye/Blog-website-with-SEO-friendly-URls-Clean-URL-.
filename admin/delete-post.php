
<?php
require_once '../config/db.php';

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if ($id) {
    $sql = "DELETE FROM posts WHERE id = $id";
    mysqli_query($conn, $sql);
}

header('Location: dashboard.php');
exit();