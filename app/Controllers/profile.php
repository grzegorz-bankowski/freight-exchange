<?php

namespace Controllers;

use App\Classes\Notify;
use App\Actions\User\UpdateUserProfile;

session_start();

if (isset($_SESSION['id'])) {
    if (($_SERVER["REQUEST_METHOD"] == "POST") && ($_POST["action"] == "update")) {

        $id = $_SESSION['id'];
        $newemail = $_POST['newemail'];

        $update = new UpdateUserProfile($db);
        $status = $update($id);

        if ($status) {
            require_once PATH . 'app/Views/profile.view.php';
            $info = new Notify();
            $info->Info('Your account has been updated.');
        } else {
            require_once PATH . 'app/Views/profile.view.php';
            $info = new Notify();
            $info->Error('We have problem with updating your account');
        }
    }

    if ($_SERVER["REQUEST_METHOD"] == "GET") {
        require_once PATH . 'app/Views/profile.view.php';
    }

} else {
    header('Location: ./?a=invalid');
}
