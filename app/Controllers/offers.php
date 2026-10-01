<?php

namespace App\Controllers;

use App\Classes\Notify;
use App\Actions\Load\OfferedLoads;
use App\Actions\Vehicle\OfferedVehicles;

session_start();

// if (isset($_SERVER['HTTP_X_TEST_ENV'])) {
//     putenv('APP_ENV=' . $_SERVER['HTTP_X_TEST_ENV']);
//     $_ENV['APP_ENV'] = $_SERVER['HTTP_X_TEST_ENV'];
//     $_SESSION['id'] = 1;
// }

$limit = 5;

if (isset($_SESSION['id'])) {

    if (($_SERVER['REQUEST_METHOD'] == 'GET')) {
        $user = $_SESSION['id'];

        $loads = new OfferedLoads($db);
        $loads = $loads($user);
        $vehicles = new OfferedVehicles($db);
        $vehicles = $vehicles($user);
        require_once PATH . 'app/Views/offers.view.php';
    }

    if (isset($_GET['load'])) {
        if ($_GET['load'] == "add") {
            $info = new Notify();
            $info->Info('Your load offer has been added.');
        }
    }

    if (isset($_GET['load'])) {
        if ($_GET['load'] == "updated") {
            $info = new Notify();
            $info->Info('Your load offer has been updated.');
        }
    }

    if (isset($_GET['vehicle'])) {
        if ($_GET['vehicle'] == "updated") {
            $info = new Notify();
            $info->Info('Your vehicle offer has been updated.');
        }
    }

    if (isset($_GET['vehicle'])) {
        if ($_GET['vehicle'] == "add") {
            $info = new Notify();
            $info->Info('Your vehicle offer has been added');
        }
    }
} else {
    header('Location: ./?a=invalid');
}
