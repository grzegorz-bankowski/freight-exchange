<?php

namespace App\Controllers;

use App\Actions\User\ResetUserPassword;
use App\Actions\User\ResetUserPasswordForm;
use App\Classes\Notify;

if (isset($_GET['token'])) {
    $token = $_GET['token'];

    $form = new ResetUserPasswordForm($db);
    $status = $form($token);

    if ($status) {
        require_once PATH . 'app/Views/reset-password.view.php';
    } else {
        $error = new Notify();
        $error->Error('The password reset token is invalid!');
        require_once PATH . 'app/Views/forgot-password.view.php';
    }
}

if (isset($_POST['action']) && $_POST['action'] == 'reset-password') {
    $token = $_POST['token'];
    $password = $_POST['password'];

    $reset = new ResetUserPassword($db);
    $status = $reset($token, $password);

    if ($status) {
        header('Location: ./?a=3');
    } elseif ($status === 'invalid') {
        $error = new Notify();
        $error->Error('The password has invalid format!');
        require_once PATH . 'app/Views/reset-password.view.php';
    } else {
        $error = new Notify();
        $error->Error('We got some errors during reseting your password!');
        require_once PATH . 'app/Views/index.view.php';
    }
}

if (!isset($_GET['token']) && !isset($_POST['token'])) {
    header('Location: ./?a=invalid');
}
