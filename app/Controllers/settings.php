<?php

namespace Controllers;

use App\Actions\User\ChangeUserEmail;
use App\Actions\User\ChangeUserPassword;
use App\Actions\User\DeleteUser;
use App\Classes\Notify;


session_start();

if (isset($_SESSION['id'])) {

    if (($_SERVER["REQUEST_METHOD"] == "POST") && ($_POST["action"] == "email")) {
        $id = $_SESSION['id'];
        $newemail = $_POST['newemail'];

        $update = new ChangeUserEmail($db);
        $status = $update($id, $newemail);

        if ($status) {
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
        $id = $_SESSION['id'];
        $newpassword = $_POST['newpassword'];

        $change = new ChangeUserPassword($db);
        $status = $change($id, $newpassword);

        if ($status) {
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
        $id = $_SESSION['id'];
        $password = $_POST['current_password'];

        $delete = new DeleteUser($db);
        $status = $delete($id, $password);

        if ($status) {
            header('Location: /?a=4');
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
    header('Location: ./?a=invalid');
}
