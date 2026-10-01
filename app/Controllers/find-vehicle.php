<?php

namespace App\Controllers;

use App\Actions\Vehicle\FindVehicle;

session_start();

if (isset($_SESSION['id']) && ($_SERVER['REQUEST_METHOD'] == 'GET')) {
    $id = $_SESSION['id'];

    $limit = 5;

    if (isset($_GET["origin"]) && $_GET["origin"] !== '') {
        $origin = $_GET["origin"];
    } else {
        $origin = '';
    }

    $start_city = $_GET["start_city"] ?? '';

    if (isset($_GET["destination"]) && $_GET["destination"] !== '') {
        $destination = $_GET["destination"];
    } else {
        $destination = '';
    }

    $end_city = $_GET["end_city"] ?? '';

    if (isset($_GET["trailer"]) && $_GET["trailer"] !== '') {
        $trailer = $_GET["trailer"];
    } else {
        $trailer = '';
    }

    if (isset($_GET["weight_min"])) {
        $weight_min = (int)$_GET["weight_min"];
    } else {
        $weight_min = 0;
    }

    if (isset($_GET["weight_max"]) && is_numeric($_GET["weight_max"])) {
        $weight_max = (int)$_GET["weight_max"];
    } else {
        $weight_max = 99999;
    }

    $offset = isset($_GET["offset"]) ? (int)$_GET["offset"] : 0;
    $offset = $offset * $limit;

    $arguments = [$origin, $start_city, $destination, $end_city, $trailer, $weight_min, $weight_max, $limit, $offset];

    $find = new FindVehicle($db);
    $array = $find($id, $arguments);
    $vehicles = $array['vehicles'];
    $total = $array['total'];

    require_once PATH . 'app/Views/find-vehicle.view.php';
} else {
    header('Location: ./?a=invalid');
}
