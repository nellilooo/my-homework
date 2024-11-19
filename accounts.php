<?php
include 'storage.php'; // Подключаем массив пользователей

// Получаем количество пользователей из GET-параметра
$count = (int)($_GET['count'] ?? 10); // По умолчанию 10
$count = $count > 0 ? $count : 10; // Минимальное значение — 1

// Получаем нужное количество пользователей
$selectedUsers = array_slice($users,  0,  $count);
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Список пользователей</title>
</head>
<body>
    <h1>Список пользователей (<?= $count ?>)</h1>
    <ul>
        <?php foreach ($selectedUsers as $user): ?>
            <li><?= htmlspecialchars($user['username']) ?> (<?= htmlspecialchars($user['email']) ?>)</li>
        <?php endforeach; ?>
    </ul>
    <form method="get">
        <label for="count">Количество пользователей:</label>
        <input type="number" id="count" name="count" min="1" value="<?= $count ?>">
        <button type="submit">Показать</button>
    </form>
    <a href="index.php">На главную</a>
</body>
</html>