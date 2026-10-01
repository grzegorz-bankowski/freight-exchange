<?php

namespace App\Controllers;

use App\Classes\Notify;
use App\Actions\User\LoginUser;
use App\Actions\Load\ReservedLoads;
use App\Actions\Vehicle\ReservedVehicles;
use App\Actions\Load\MoreLoad;
use App\Actions\Load\CancelLoad;
use App\Actions\Vehicle\MoreVehicle;
use App\Actions\Vehicle\CancelVehicle;

session_start();

if (isset($_SERVER['HTTP_X_TEST_ENV'])) {
    putenv('APP_ENV=' . $_SERVER['HTTP_X_TEST_ENV']);
    $_ENV['APP_ENV'] = $_SERVER['HTTP_X_TEST_ENV'];
    $_SESSION['id'] = 1;
}

if(($_SERVER['REQUEST_METHOD'] == "POST") && ($_POST['action'] == "login")) {

    $email = $_POST['email'];
    $password = $_POST['password'];

    $user = new LoginUser($db);
    $status = $user($email, $password);

    if ($status) {
        $loads = new ReservedLoads($db);
        $loads = $loads($_SESSION['id']);

        $vehicles = new ReservedVehicles($db);
        $vehicles = $vehicles($_SESSION['id']);

        require_once PATH . 'app/Views/orders.view.php';
        $info = new Notify();
        $info->Info('You have successfully logged in.');
    } else {
        header('Location: ./?a=error');
    }
}

if (($_SERVER['REQUEST_METHOD'] == 'GET') && (isset($_GET['action']))) {

    if ($_GET['action'] == "load-more") {
        $id = $_GET['id'];

        $load = new MoreLoad($db);
        $load = $load($id);
        require_once PATH . 'app/Views/load.view.php';

    } elseif ($_GET['action'] == "load-cancel") {

        $id = $_GET['id'];
        $user = $_SESSION['id'];

        $delete = new CancelLoad($db);
        $delete($id);

        $loads = new ReservedLoads($db);
        $loads = $loads($user);

        $vehicles = new ReservedVehicles($db);
        $vehicles = $vehicles($user);

        require_once PATH . 'app/Views/orders.view.php';
        $info = new Notify();
        $info->Info('You have successfully canceled load order');

    } elseif ($_GET['action'] == 'vehicle-more') {
        $id = $_GET['id'];

        $vehicle = new MoreVehicle($db);
        $vehicle = $vehicle($id);
        require_once PATH . 'app/Views/vehicle.view.php';

    } elseif ($_GET['action'] == "vehicle-cancel") {

        $id = $_GET['id'];
        $user = $_SESSION['id'];

        $delete = new CancelVehicle($db);
        $delete($id);

        $loads = new ReservedLoads($db);
        $loads = $loads($user);

        $vehicles = new ReservedVehicles($db);
        $vehicles = $vehicles($user);

        require_once PATH . 'app/Views/orders.view.php';
        $info = new Notify();
        $info->Info('You have successfully canceled vehicle order');
    }
}

if ((isset($_SESSION["id"])) && (!isset($_GET["action"]))) {

    $user = $_SESSION['id'];

    $loads = new ReservedLoads($db);
    $loads = $loads($user);

    $vehicles = new ReservedVehicles($db);
    $vehicles = $vehicles($user);
    
    require_once PATH . 'app/Views/orders.view.php';
}

if (isset($_GET['logged'])) {
    if ($_GET['logged'] == 1) {
        $info = new Notify();
        $info->Info('You are currently logged in.');
    }
}