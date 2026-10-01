<?php

namespace App\Controllers;

use App\Actions\User\ForgotUserPassword;
use App\Classes\Notify;

if (isset($_POST['recover'])) {
    if ($_POST['recover'] == '1') {
        $email = $_POST['email'];

        $forgot = new ForgotUserPassword($db);
        $status = $forgot($email);

        if ($status === true) {
            $info = new Notify();
            $info->Info('A link to reset your password has been sent to your email address.');
            require_once PATH . 'app/Views/forgot-password.view.php';

        } elseif ($status === 'none') {
            $error = new Notify();
            $error->Error('We do not have an account assigned to this email address!');
            require_once PATH . 'app/Views/forgot-password.view.php';

        } elseif ($status === 'invalid') {
            $error = new Notify();
            $error->Error('This email address is invalid!');
            require_once PATH . 'app/Views/forgot-password.view.php';

        } elseif ($status === 'empty') {
            $error = new Notify();
            $error->Error('Email address cannot be empty!');
            require_once PATH . 'app/Views/forgot-password.view.php';

        } else {
            $error = new Notify();
            $error->Error('We had problem with sending reset link to your email address.');
            require_once PATH . 'app/Views/forgot-password.view.php';
        }
    }
} else {
    require_once PATH . 'app/Views/forgot-password.view.php';
}