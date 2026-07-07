<?php

namespace App\Controllers;

use App\Classes\Database;
use App\Classes\Validator;
use App\Classes\Notify;

if (isset($_POST['recover'])) {
    if ($_POST['recover'] == '1') {
        $email = $_POST['email'];
        $validator = new Validator();
        $validator = $validator->validateEmail($email);
        if($validator) {
            $db = new Database();
            $stmt = $db->connection->prepare("SELECT * FROM users WHERE email = :email");
            $stmt->execute(['email' => $email]);
            if ($stmt->rowCount() > 0) {
                $token = bin2hex(random_bytes(16));
                $sql = "UPDATE users SET token = :token WHERE email = :email";
                $stmt = $db->connection->prepare($sql)->execute(["token" => $token, "email" => $email]);
                require_once 'send-token.php';
                $info = new Notify();
                $info->Info('A link to reset your password has been sent to your email address.');
                require_once PATH . 'app/Views/index.view.php';
            } else {
                header('Location: ./forgot-password?email=none');
            }
        } else {
            header('Location: ./forgot-password?email=invalid');
        }
    }
}

if (isset($_GET['email'])) {
    if ($_GET['email'] == 'none') {
        $error = new Notify();
        $error->Info('We do not have an account assigned to this email address!');
        require_once PATH . 'app/Views/forgot-password.view.php';
    }
}

if (isset($_GET['email'])) {
    if ($_GET['email'] == 'invalid') {
        $error = new Notify();
        $error->Info('This email address is invalid!');
        require_once PATH . 'app/Views/forgot-password.view.php';
    }
}

if ((!isset($_POST['recover'])) && (!isset($_GET['email']))) {
    require_once PATH . 'app/Views/forgot-password.view.php';
}
