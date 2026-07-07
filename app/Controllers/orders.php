<?php

namespace Controllers;

use App\Classes\Database;
use App\Classes\Notify;

session_start();

$db = new Database();

if(($_SERVER['REQUEST_METHOD'] == "POST") && ($_POST['action'] == "login")) {
    $stmt = $db->connection->prepare("SELECT * FROM users WHERE email = :email");
    $stmt->execute(['email' => $_POST['email']]);
    $user = $stmt->fetch();
    $total = $stmt->rowCount();
    if ($total > 0) {
        if (password_verify($_POST['password'], $user['password'])) {
            $_SESSION['id'] = $user['id'];
            $_SESSION['email'] = $user['email'];
            $_SESSION['name'] = $user['name'];
            $_SESSION['password'] = $user['password'];
            $_SESSION['street'] = $user['street'];
            $_SESSION['city'] = $user['city'];
            $_SESSION['code'] = $user['code'];
            $_SESSION['country'] = $user['country'];
            $_SESSION['vat'] = $user['vat'];
            $_SESSION['phone'] = $user['phone'];
            $_SESSION['website'] = $user['website'];

            $info = new Notify();
            $info->Info('You have successfully logged in.');
        } else {
            header('Location: ./?login=error');
        }
    } else {
        header('Location: ./?login=error');
    }
}

if (($_SERVER['REQUEST_METHOD'] == 'GET') && (isset($_GET['action']))) {

    $db = new Database();

    if ($_GET['action'] == "load-more") {

        $id = $_GET['id'];

        $stmt = $db->connection->prepare("SELECT loads.id, loads.user_id, loads.places, loads.citys, loads.codes, loads.countrys, loads.streets, loads.dates, loads.times, loads.placed, loads.countryd, loads.cityd, loads.coded, loads.streetd,  loads.dated, loads.timed, loads.trailer, loads.weight, loads.type_of_good, loads.number_of_package, loads.type_of_package, loads.distance, loads.payrate, loads.rate_per_km, loads.description, users.phone, users.email, users.website FROM loads INNER JOIN users ON loads.user_id = users.id WHERE loads.id = :id");
        $stmt->execute(array(":id" => $id));
        $load = $stmt->fetch();

        require_once PATH . 'app/Views/load.view.php';

    } elseif ($_GET['action'] == "load-cancel") {

        $id = $_GET['id'];
        $user = $_SESSION['id'];

        $sql = "UPDATE loads SET reserved = ?,  reserved_by = ? WHERE id = ?";
        $stmt = $db->connection->prepare($sql)->execute(['no', 0, $id]);

        $stmt = $db->connection->prepare("SELECT id, user_id, DATE_FORMAT(dates, '%d-%m-%Y') AS formatted_dates, DATE_FORMAT(dates, '%H:%i') AS formatted_times, citys, codes, countrys, DATE_FORMAT(dated, '%d-%m-%Y') AS formatted_dated, DATE_FORMAT(dated, '%H:%i') AS formatted_timed, cityd, coded, countryd, trailer, weight, distance, payrate, rate_per_km, description FROM loads WHERE reserved_by = :user");
        $stmt->execute(array(":user" => $user));
        if($stmt->rowCount() > 0){
            $loads = $stmt->fetchAll();
        } else {
            $loads = 0;
        }

        $stmt = $db->connection->prepare("SELECT id, user_id, DATE_FORMAT(dates, '%d-%m-%Y') AS formatted_dates, DATE_FORMAT(dates, '%H:%i') AS formatted_times, citys, codes, countrys, DATE_FORMAT(dated, '%d-%m-%Y') AS formatted_dated, DATE_FORMAT(dated, '%H:%i') AS formatted_timed, cityd, coded, countryd, trailer, weight, distance, payrate, rate_per_km, description FROM vehicles WHERE reserved_by = :user");
        $stmt->execute(array(":user" => $user));
        if ($stmt->rowCount() > 0) {
            $vehicles = $stmt->fetchAll();
        } else {
            $vehicles = 0;
        }

        require_once PATH . 'app/Views/orders.view.php';
        $info = new Notify();
        $info->Info('You have successfully canceled load order');

    } elseif ($_GET['action'] == "vehicle-cancel") {

        $id = $_GET['id'];
        $user = $_SESSION['id'];

        $sql = "UPDATE vehicles SET reserved = ?,  reserved_by = ? WHERE id = ?";
        $stmt = $db->connection->prepare($sql)->execute(['no', 0, $id]);

        $stmt = $db->connection->prepare("SELECT id, user_id, dates, times, citys, codes, countrys, dated, timed, cityd, coded, countryd, trailer, weight, distance, payrate, rate_per_km, description FROM loads WHERE reserved_by = :user");
        $stmt->execute(array(":user" => $user));
        if($stmt->rowCount() > 0){
            $loads = $stmt->fetchAll();
        } else {
            $loads = 0;
        }

        $stmt = $db->connection->prepare("SELECT id, user_id, dates, times, citys, codes, countrys, dated, timed, cityd, coded, countryd, trailer, weight, distance, payrate, rate_per_km, description FROM vehicles WHERE reserved_by = :user");
        $stmt->execute(array(":user" => $user));
        if($stmt->rowCount() > 0){
            $vehicles = $stmt->fetchAll();
        } else {
            $vehicles = 0;
        }

        require_once PATH . 'app/Views/orders.view.php';
        $info = new Notify();
        $info->Info('You have successfully canceled vehicle order');
    }
}

if ((isset($_SESSION["id"])) && (!isset($_GET["action"]))) {

    $user = $_SESSION['id'];

    $stmt = $db->connection->prepare("SELECT id, user_id, dates, times, citys, codes, countrys, dated, timed,  cityd, coded, countryd, trailer, weight, distance, currency, payrate, rate_per_km, description FROM loads WHERE reserved_by = :user");
    $stmt->execute(array(":user" => $user));
    if($stmt->rowCount() > 0){
        $loads = $stmt->fetchAll();
    } else {
        $loads = 0;
    }

    $stmt = $db->connection->prepare("SELECT id, user_id, dates, times, citys, codes, countrys, dated, timed, cityd, coded, countryd, trailer, weight, distance, currency, payrate, rate_per_km, description FROM vehicles WHERE reserved_by = :user");
    $stmt->execute(array(":user" => $user));
    if($stmt->rowCount() > 0){
        $vehicles = $stmt->fetchAll();
    } else {
        $vehicles = 0;
    }

    require_once PATH . 'app/Views/orders.view.php';
}

if (isset($_GET['logged'])) {
    if ($_GET['logged'] == 1) {
        $info = new Notify();
        $info->Info('You are currently logged in.');
    }
}

if (!isset($_SESSION["id"])) {
    header('Location: ./?url=invalid');
}
