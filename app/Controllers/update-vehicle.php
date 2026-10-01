<?php

namespace App\Controllers;

use App\Actions\Vehicle\UpdateVehicle;
use App\Classes\Notify;

session_start();

if (isset($_POST['id'])) {
    $id = $_POST['id'];
    $user = $_SESSION['id'];

    $update = new UpdateVehicle($db);
    $status = $update($id);

    if ($status) {
        header('Location: ./offers?vehicle=updated');
    } else {
        require_once PATH . 'app/Views/edit-vehicle.view.php';
        $error = new Notify();
        $error->Error('We had problem during updating your load offer.');
    }
}