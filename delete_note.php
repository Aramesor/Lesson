<?php
include('database.php');
if (isset($_GET['delete_id'])) {
    $id = $_GET['delete_id'];
    $stmt = $connection->prepare('DELETE FROM notes WHERE id = ?');
    $stmt->bind_param('i', $id);
    $stmt->execute();
    header("Location: index.php");
    exit();
}

?>