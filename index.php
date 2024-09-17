<?php
// Включаем подключение к базе данных
include('database.php');
include('edit_note.php');
include('delete_note.php');
// Обработка POST запросов для добавления и обновления заметок

  




// Получение заметки для редактирования
$note = null;
if (isset($_GET['edit_id'])) {
    $id = $_GET['edit_id'];
    $stmt = $connection->prepare('SELECT * FROM notes WHERE id = ?');
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $note = $result->fetch_assoc();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notes</title>
</head>
<body>
    <!-- Форма добавления заметки -->
    <form method="post" action="index.php">
        <input type="text" name="name" placeholder="Enter a note" required>
        <button type="submit">Add</button>
    </form>

    <!-- Форма редактирования заметки -->
    <?php if ($note): ?>
    <form method="post" action="index.php">
        <input type="hidden" name="id" value="<?php echo htmlspecialchars($note['id']); ?>">
        <input type="text" name="name" value="<?php echo htmlspecialchars($note['name']); ?>" required>
        <button type="submit">Update</button>
    </form>
    <?php endif; ?>

    <!-- Список заметок -->
    <ul>
    <?php
    $result = $connection->query("SELECT id, name FROM notes");
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<li>" . htmlspecialchars($row['name']) .
                " <a href='index.php?delete_id=" . $row['id'] . "'>Delete</a> | " .
                " <a href='index.php?edit_id=" . $row['id'] . "'>Edit</a></li>";
        }
    } else {
        echo "<li>There are no notes.</li>";
    }
    $connection->close();
    ?>
    </ul>
</body>
</html>