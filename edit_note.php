<?php
include('database.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['id']) && !empty($_POST['id'])) {
        // Обновление заметки
        $id = $_POST['id'];
        $name = $_POST['name'];
        $stmt = $connection->prepare("UPDATE notes SET name = ? WHERE id = ?");
        $stmt->bind_param('si', $name, $id);
        if ($stmt->execute()) {
            header('Location: index.php');
            exit();
        } else {
            echo "Ошибка при обновлении заметки.";
        }  } else {
        
        $name = $_POST['name'];
        $stmt = $connection->prepare("INSERT INTO notes (name) VALUES (?)");
        $stmt->bind_param('s', $name);
        if ($stmt->execute()) {
            header('Location: index.php');
            exit();
        } else {
            echo "Ошибка при добавлении заметки.";
        }
    }
}
?>