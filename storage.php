<?php
// Указываем путь к JSON файлу
$jsonFilePath = 'users.json';

// Проверяем, существует ли файл
if (file_exists($jsonFilePath)) {
    // Читаем содержимое файла
    $jsonData = file_get_contents($jsonFilePath);
    
    // Декодируем JSON данные в ассоциативный массив
    $usersArray = json_decode($jsonData, true);
    
    // Проверяем, удалось ли декодировать данные
    if (json_last_error() === JSON_ERROR_NONE) {
        // Массив успешно создан
        print_r($usersArray); // Для отладки
    } else {
        // Обработка ошибки JSON
        echo "Ошибка при декодировании JSON: " . json_last_error_msg();
    }
} else {
    echo "Файл не найден: $jsonFilePath";
}
?>
