<?php

function caesarEncryption($text, $shift) {
    $encrypted = '';
    
    // цикл: по каждому символу
    foreach (str_split( $text) as $char) {
        // проверка на символ
        if (ctype_alpha($char)) {
            $shifted = ord($char) + $shift;
            // проверка на диапазон символов
            if (ctype_upper($char)) {
                // только большие 
                if ($shifted > ord('Z')) {
                    $shifted -= 26; // в начало алфавита
                }
            } else {
                // только маленькие 
                if ($shifted > ord('z')) {
                    $shifted -= 26; // в начало алфавита
                }
            }
            $encrypted .= chr($shifted);
        } else {
            $encrypted .= $char; // не трогаем "не" буквы
        }
    }
    
    printf("%s : %d\n<br>", $encrypted, $shift);
    return $encrypted;
}

function caesarDecryption($encryptedMessage, $shift) {
    return caesarEncryption($encryptedMessage, -$shift); //шифт отрицательный для шифра "в обратную" = расшифровка
}

$message = "Mama, I love u!";
$shift = 3;

$encryptedMessage = caesarEncryption($message, $shift);
$decryptedMessage = caesarDecryption($encryptedMessage, $shift);

