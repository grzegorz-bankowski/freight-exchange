<?php

namespace App\Controllers;

use App\Classes\Database;
use App\Classes\Validator;
use App\Classes\Notify;

if (isset($_GET['token'])) {
    $token = $_GET['token'];
    $db = new Database();

    $stmt = $db->connection->prepare("SELECT * FROM users WHERE token = :token");
    $stmt->execute([':token' => $token]);
    if ($stmt->rowCount() > 0) {
        require_once PATH . 'app/Views/reset-password.view.php';
    } else {
        $error = new Notify();
        $error->Error('The password reset token is invalid!');
        require_once PATH . 'app/Views/reset-password.view.php';
    }
}

if (isset($_POST['action'])) {
    if ($_POST['action'] == 'reset-password') {
        $token = $_POST['token'];
        $password = $_POST['password'];
        $check = new Validator();
        $check = $check->validatePassword($password);
        if ($check) {
            $password = password_hash($password, PASSWORD_DEFAULT);
            $db = new Database();
            $stmt = $db->connection->prepare("UPDATE users SET password = :password WHERE token = :token");
            $stmt->execute([':token' => $token, ':password' => $password]);
            if ($stmt->rowCount() > 0) {
                header('Location: ./?password=changed');
            } else {
                $error = new Notify();
                $error->Error('We got some errors during reset password!');
                require_once PATH . 'app/Views/reset-password.view.php';
            }
        } else {
            $error = new Notify();
            $error->Error('The password has invalid format!');
            require_once PATH . 'app/Views/reset-password.view.php';
        }
    }
}

if (!isset($_GET['token']) && !isset($_POST['token'])) {
    header('Location: ./?url=invalid');
}
