<?php

namespace App\Controllers;

use App\Actions\Vehicle\DeleteVehicle;
use App\Actions\Vehicle\OfferedVehicles;
use App\Actions\Load\OfferedLoads;
use App\Classes\Notify;

session_start();

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $user = $_SESSION['id'];

    $delete = new DeleteVehicle($db);
    $status = $delete($id);

    $loads = new OfferedLoads($db);
    $loads = $loads($user);

    $vehicles = new OfferedVehicles($db);
    $vehicles = $vehicles($user);

    if ($status) {
        require_once PATH . 'app/Views/offers.view.php';
        $info = new Notify();
        $info->Info('You have successfully deleted load offer.');
    } else {
        require_once PATH . 'app/Views/offers.view.php';
        $info = new Notify();
        $info->Error('We had problem during deleting your load offer.');
    }
}
