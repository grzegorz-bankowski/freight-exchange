<?php

namespace App\Controllers;

use App\Classes\Database;
use App\Classes\Validator;
use App\Classes\Notify;

if($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = new Validator();
    $email = $email->validateEmail(trim($_POST["email"]));
    $password = new Validator();
    $password = $password->validatePassword($_POST["password"]);
    if($email && $password) {
        $db = new Database();
        $_POST["password"] = password_hash($_POST["password"], PASSWORD_DEFAULT);
        $stmt = $db->connection->prepare("INSERT INTO users (email, password) VALUES (:email, :password)");
        $stmt->execute(['email' => $_POST['email'], 'password' => $_POST['password']]);
        if ($stmt->rowCount() > 0) {
            require_once 'send-email.php';
        } else {
            header('Location: ./register?account=error');
        }
    } else {
        header('Location: ./register?data=invalid');
    }
}

if (isset($_GET['account'])) {
    if ($_GET['account'] == "error") {
        $error = new Notify();
        $error->Error('There was an error creating your account. Please try again!');
    }
}

if (isset($_GET['data'])) {
    if ($_GET['data'] == "invalid") {
        $error = new Notify();
        $error->Error('Email and password cannot be empty and must have correct format!');
    }
}

require_once PATH . 'app/Views/register.view.php';
