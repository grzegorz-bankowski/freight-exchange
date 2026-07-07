<?php

namespace App\Controllers;

use App\Classes\Notify;

session_start();

if (isset($_SESSION['id'])) {
    header('Location: ./orders?logged=1');
} else {
    require_once PATH . '/app/Views/index.view.php';
}

if (isset($_GET['login'])) {
    if ($_GET['login'] == "error") {
        $error = new Notify();
        $error->Error('Your login credentials are invalid.');
    }
}

if (isset($_GET['logout'])) {
    $info = new Notify();
    $info->Info('You have been successfully logged out.');
}

if (isset($_GET['account'])) {
    if ($_GET['account'] == "created") {
        $info = new Notify();
        $info->Info('Your account has been created. You can now sign in.');
    }
}

if (isset($_GET['password'])) {
    if ($_GET['password'] == "changed") {
        $info = new Notify();
        $info->Info('Your password has been changed.');
    }
}

if (isset($_GET['account'])) {
    if ($_GET['account'] == "deleted") {
        session_start();
        $_SESSION = [];
        session_destroy();
        $info = new Notify();
        $info->Info('Your account has been successfully deleted');
    }
}

if (isset($_GET['url'])) {
    if ($_GET['url'] == "invalid") {
        $error = new Notify();
        $error->Error('The page doesn\'t exist.');
    }
}
