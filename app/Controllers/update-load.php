<?php

namespace App\Controllers;

use App\Actions\Load\UpdateLoad;
use App\Classes\Notify;

session_start();

if (isset($_POST['id'])) {
    $id = $_POST['id'];
    $user = $_SESSION['id'];

    $edit = new UpdateLoad($db);
    $status = $edit($id);

    if ($status) {
        header('Location: ./offers?load=updated');
    } else {
        require_once PATH . 'app/Views/edit-load.view.php';
        $error = new Notify();
        $error->Error('We had problem during updating your load offer.');
    }
}