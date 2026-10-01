<?php

namespace App\Controllers;

use App\Actions\Vehicle\AddVehicle;
use App\Classes\Notify;

session_start();

$_POST['places'] = isset($_POST['places']) ? $_POST['places'] : '';
$_POST['countrys'] = isset($_POST['countrys']) ? $_POST['countrys'] : '';
$_POST['countryd'] = isset($_POST['countryd']) ? $_POST['countryd'] : '';
$_POST['type_of_package'] = isset($_POST['type_of_package']) ? $_POST['type_of_package'] : '';
$_POST['trailer'] = isset($_POST['trailer']) ? $_POST['trailer'] : '';
$_POST['currency'] = isset($_POST['currency']) ? $_POST['currency'] : '';

if (isset($_SESSION['id'])) {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $id = $_SESSION['id'];

        $vehicle = new AddVehicle($db);
        $status = $vehicle($id);

        if ($status) {
            header('Location: ./offers?vehicle=add');
        } else {
            require_once PATH . 'app/Views/add-vehicle.view.php';
            $error = new Notify();
            $error->Error('We have problem with adding this vehicle offer');
        }   
    }

    if ($_SERVER["REQUEST_METHOD"] == "GET") {
        require_once PATH . 'app/Views/add-vehicle.view.php';
    }

} else {
    header('Location: ./?a=invalid');
}
