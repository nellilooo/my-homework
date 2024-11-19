<?php
// Файл: seeder.php

function generateUniqueNames($count) {
    $names = [];
    while (count($names) < $count) {
        $name = 'user_' . uniqid();
        $names[] = $name;
    }
    return $names;
}

function hashPassword($password) {
    return password_hash($password, PASSWORD_DEFAULT);
}

$users = [];
$uniqueNames = generateUniqueNames(10000);
$password = 'password123'; // фиксированный пароль

foreach ($uniqueNames as $name) {
    $users[] = [
        'username' => $name,
        'password' => hashPassword($password)
    ];
}

file_put_contents('users.json', json_encode($users));
echo "Пользователи успешно созданы!";
