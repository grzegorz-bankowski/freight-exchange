<?php

namespace App\Controllers;

use App\Actions\Vehicle\EditVehicle;
use App\Actions\Vehicle\OfferedVehicles;
use App\Actions\Load\OfferedLoads;
use App\Classes\Notify;

session_start();

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $user = $_SESSION['id'];

    $vehicle = new EditVehicle($db);
    $array = $vehicle($id, $user);

    $status = $array['status'];
    $vehicle = $array['vehicle'];

    if ($status) {
        require_once PATH . 'app/Views/edit-vehicle.view.php';
    } else {
        $loads = new OfferedLoads($db);
        $loads = $loads($_SESSION['id']);

        $vehicles = new OfferedVehicles($db);
        $vehicles = $vehicles($user);

        require_once PATH . 'app/Views/offers.view.php';
        $error = new Notify();
        $error->Error('The page doesn\'t exist.');
    }
}