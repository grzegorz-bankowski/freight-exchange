<?php

namespace App\Controllers;

use App\Actions\Vehicle\PreviewVehicle;

session_start();

if (isset($_SESSION['id'])) {
    $id = $_GET['id'];

    $preview = new PreviewVehicle($db);
    $array = $preview($id);
    $vehicle = $array['vehicle'];
    $status = $array['status'];
    $origin = $array['origin'];
    if ($status) {
        require_once PATH . 'app/Views/vehicle.view.php';
    } 
} else {
    header('Location: ./?a=invalid');
}
