<?php
namespace PhpChat\Functions;

define('DATA_FILE', __DIR__ . '/data/soobshenya.txt');

function validateMessage($message) {
    $errors = [];
    if (empty($message['name'])) {
        $errors['name'] = 'Не заполнено имя';
    }
    if (empty($message['text'])) {
        $errors['text'] = 'Не заполнен текст сообщения';
    }
    return $errors;
}

function saveMessageToFile($message) {
    $message['time'] = time();
    $messages = readMessagesFromFile();
    $messages[] = $message;
    return file_put_contents(DATA_FILE, serialize($messages)) !== false;
}

function readMessagesFromFile() {
    $messages = [];
    if (file_exists(DATA_FILE)) {
        $messages = unserialize(file_get_contents(DATA_FILE));
    }
    return $messages;
}

function sendErrors($errors) {
    header('HTTP/1.1 400 Bad Request');
    echo implode("\n", $errors);
}

function sendMessages($messages) {
    header('Content-Type: application/json');
    echo json_encode($messages);
}