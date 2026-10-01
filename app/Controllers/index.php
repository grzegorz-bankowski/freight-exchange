<?php

namespace App\Controllers;

use App\Classes\Notify;

session_start();

if (isset($_SESSION['id'])) {
    header('Location: ./orders?logged=1');
} else {
    require_once PATH . '/app/Views/index.view.php';
}

if (isset($_GET['a'])) {
    switch ($_GET['a']) {
        case 'created':
            $info = new Notify();
            $info->Info('Your account has been created. You can now sign in.');
            break;

        case 'error':
            $error = new Notify();
            $error->Error('Your login credentials are invalid.');
            break;

        case 'changed':
            $info = new Notify();
            $info->Info('Your password has been changed.');
            break;

        case 'deleted':
            $_SESSION = [];
            session_destroy();
            $info = new Notify();
            $info->Info('Your account has been successfully deleted');
            break;

        case 'invalid':
            $error = new Notify();
            $error->Error('The page doesn\'t exist.');
            break;

        case 'token':
            $error = new Notify();
            $error->Error('');

        case 'logout':
            $info = new Notify();
            $info->Info('You have been successfully logged out.');
            break;
    }
}