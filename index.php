<?php
// Файл: index.php
session_start();
$jsonFilePath = 'users.json';

// Проверяем, существует ли файл
if (file_exists($jsonFilePath)) {
    // Читаем содержимое файла
    $jsonData = file_get_contents($jsonFilePath);
    // Декодируем JSON данные в ассоциативный массив
    $usersArray = json_decode($jsonData, true);
    // Проверяем, удалось ли декодировать данные
    /*if (json_last_error() === JSON_ERROR_NONE) {
        // Массив успешно создан
        print_r($usersArray); // Для отладки
    } else {
        // Обработка ошибки JSON
        echo "Ошибка при декодировании JSON: " . json_last_error_msg();
    }*/
}
$error = ''; // Переменная для хранения ошибок

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';

    // Валидация
    if (!$username || !$password) {
        $error = 'Заполните все поля.';
    } else {
        // Поиск пользователя
        $user = array_filter($usersArray, fn($u) => $u['username'] === $username);
        if ($user) {
            $user = reset($user); // Берём первого найденного пользователя
            if (password_verify($password, $user['password'])) {
                // Авторизация успешна
                $_SESSION['user'] = $user;
                header('Location: about.php'); // Переход на страницу пользователя
                exit;
            }
            /*} else {
                $error = 'Неверный пароль.';
            }
        } else {
            $error = 'Пользователь не найден.';
        }*/}
    }
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Авторизация</title>
</head>
<body>
    <h1>Авторизация</h1>
    <?php if ($error): ?>
        <p style="color: red;"><?= htmlspecialchars($error) ?></p>
    <?php endif; ?>
    <form method="post" action="index.php">
        <label>Логин:</label>
        <input type="text" name="username" required><br>
        <label>Пароль:</label>
        <input type="password" name="password" required><br>
        <button type="submit" onclick="document.location='about.php'">Войти</button>
    </form>
</body>
</html>
