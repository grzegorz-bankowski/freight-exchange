<?php

namespace App\Controllers;

use App\Actions\User\RegisterUser;
use App\Classes\Notify;

if($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $create = new RegisterUser($db);
    $status = $create($email, $password);

    if ($status === true) {
        header('Location: ./?a=created');
    } elseif ($status === 'error') {
        $error = new Notify();
        $error->Error('There was an error creating your account!');
    } elseif ($status === 'invalid') {
        $error = new Notify();
        $error->Error('Email and password cannot be empty and must have correct format!');
    }
}

require_once PATH . 'app/Views/register.view.php';
