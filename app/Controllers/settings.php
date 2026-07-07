<?php

namespace Controllers;

use App\Classes\Database;
use App\Classes\Validator;
use App\Classes\Notify;

session_start();

if (isset($_SESSION['id'])) {

    if (($_SERVER["REQUEST_METHOD"] == "POST") && ($_POST["action"] == "email")) {
        $email = new Validator();
        $email = $email->validateEmail(trim($_POST['newemail']));
        if ($email === true) {
            $id = $_SESSION['id'];
            $newemail = $_POST["newemail"];
            $db = new Database();
            $stmt = $db->connection->prepare("UPDATE users SET email = :email WHERE id = :id");
            $stmt->execute([':email' => $newemail, ':id' => $id]);
            $_SESSION['email'] = $_POST['newemail'];
            $info = new Notify();
            $info->Info('Your e-mail has been successfully updated.');
            require_once PATH . 'app/Views/settings.view.php';
        } else {
            $error = new Notify();
            $error->Error('Your new e-mail address is invalid!');
            require_once PATH . 'app/Views/settings.view.php';
        }
    }

    if (($_SERVER["REQUEST_METHOD"] == "POST") && ($_POST["action"] == "password")) {
        $password = new Validator();
        $password = $password->validatePassword($_POST["newpassword"]);
        if ($password) {
            $password = password_hash($_POST["newpassword"], PASSWORD_DEFAULT);
            $db = new Database();
            $id = $_SESSION['id'];
            $stmt = $db->connection->prepare("UPDATE users SET password = :password WHERE id = :id");
            $stmt->execute([':password' => $password, ':id' => $id]);
            $_SESSION['password'] = $password;
            $info = new Notify();
            $info->Info('Your password changed successfully.');
            require_once PATH . 'app/Views/settings.view.php';
        } else {
            $error = new Notify();
            $error->Error('Your new password is invalid!');
            require_once PATH . 'app/Views/settings.view.php';
        }
    }

    if (($_SERVER["REQUEST_METHOD"] == "POST") && ($_POST["action"] == "delete")) {
        if (password_verify($_POST['current_password'], $_SESSION['password'])) {
            $db = new Database();
            $id = $_SESSION['id'];
            $stmt = $db->connection->prepare("DELETE FROM users WHERE id = :id");
            $stmt->execute([':id' => $id]);
            header('Location: /?account=deleted');
        } else {
            $error = new Notify();
            $error->Error('Your current password is invalid!');
            require_once PATH . 'app/Views/settings.view.php';
        }
    }

    if ($_SERVER["REQUEST_METHOD"] == "GET") {
        require_once PATH . 'app/Views/settings.view.php';
    }

} else {
    header('Location: ./?url=invalid');
}
