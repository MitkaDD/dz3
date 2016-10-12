<?php
namespace PhpChat\App;

require 'functions.php';

use PhpChat\Functions as Functions;

if (isset($_POST['messages'])) {
    $errors = Functions\validateMessage($_POST['messages']);
    if ($errors) {
        Functions\sendErrors($errors);
    } else {
        Functions\saveMessageToFile($_POST['messages']);
    }
} else {
    $messages = Functions\readMessagesFromFile();
    Functions\sendMessages($messages);
}