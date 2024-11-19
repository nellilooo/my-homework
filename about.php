<?php
session_start();

// Проверяем, авторизован ли пользователь
if (!isset($_SESSION['user'])) {
    header('Location: index.php');
    exit;
}

$user = $_SESSION['user']; // Данные о пользователе
?>

<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <title>О пользователе</title>
</head>

<body>
    <h1>Добро пожаловать, <?= htmlspecialchars($user['username']) ?>!</h1>
    <p>Email: <?= htmlspecialchars($user['email']) ?></p>

    <h2>Информация о сервере</h2>
    <ul>
        <?php foreach ($_SERVER as $key => $value): ?>
            <li>
                <strong><?= htmlspecialchars($key) ?>:</strong>
                <?php if (is_array($value)): ?>
                    <?= htmlspecialchars(print_r($value, true)) ?>
                <?php else: ?>
                    <?= htmlspecialchars($value) ?>
                <?php endif; ?>
            </li>
        <?php endforeach; ?>
    </ul>
    <a href="index.php">Выйти</a>
    <a href="account.php">Аккаунты</a>
</body>

</html>