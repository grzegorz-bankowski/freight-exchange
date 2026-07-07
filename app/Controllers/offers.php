<?php

namespace App\Controllers;

use App\Classes\Database;
use App\Classes\Notify;

session_start();

$limit = 5;

if (isset($_SESSION['id'])) {

    if (($_SERVER['REQUEST_METHOD'] == 'GET') && (isset($_GET['action']))) {

        $db = new Database();

        if ($_GET['action'] == "load-more") {

            $id = $_GET['id'];

            $stmt = $db->connection->prepare("SELECT loads.id, loads.user_id, loads.dates, loads.times, loads.places, loads.streets, loads.citys, loads.codes, loads.countrys, loads.dated, loads.timed, loads.placed, loads.streetd, loads.cityd, loads.coded, loads.countryd, loads.trailer, loads.weight, loads.type_of_good, loads.number_of_package, loads.type_of_package, loads.distance, loads.currency, loads.payrate, loads.rate_per_km, loads.description, users.phone, users.email, users.website FROM loads INNER JOIN users ON loads.user_id = users.id WHERE loads.id = :id");
            $stmt->execute(['id' => $id]);
            require_once PATH . 'app/Views/load.view.php';

        } elseif ($_GET['action'] == "load-cancel") {

            $id = $_GET['id'];
            $user = $_SESSION['id'];

            $sql = "UPDATE loads SET reserved = ?,  reserved_by = ? WHERE id = ?";
            $stmt = $db->connection->prepare($sql)->execute(['no', 0, $id]);

            $stmt = $db->connection->prepare("SELECT id, user_id, dates, times, citys, codes, countrys, dated, timed, cityd, coded, countryd, trailer, weight, distance, payrate, currency, rate_per_km, description FROM loads WHERE reserved_by = :user");
            $stmt->execute(['user' => $user]);
            if ($stmt->rowCount() > 0) {
                $loads = $stmt->fetchAll();
            } else {
                $loads = 0;
            }

            $stmt = $db->connection->prepare("SELECT id, user_id, dates, times, citys, codes, countrys, dated, timed, cityd, coded, countryd, trailer, weight, distance, payrate, currency, rate_per_km, description FROM vehicles WHERE reserved_by = :user");
            $stmt->execute(['user' => $user]);
            if ($stmt->rowCount() > 0) {
                $vehicles = $stmt->fetchAll();
            } else {
                $vehicles = 0;
            }

            require_once PATH . 'app/Views/offers.view.php';
            $info = new Notify();
            $info->Info('You have successfully canceled load offer.');

        } elseif ($_GET['action'] == "vehicle-cancel") {

            $id = $_GET['id'];
            $user = $_SESSION['id'];

            $sql = "UPDATE vehicles SET reserved = ?,  reserved_by = ? WHERE id = ?";
            $stmt = $db->connection->prepare($sql)->execute(['no', 0, $id]);

            $stmt = $db->connection->prepare("SELECT id, user_id, dates, times, citys, codes, countrys, dated, timed, cityd, coded, countryd, trailer, weight, distance, payrate, currency, rate_per_km, description FROM loads WHERE reserved_by = :user");
            $stmt->execute(['user' => $user]);
            if ($stmt->rowCount() > 0) {
                $loads = $stmt->fetchAll();
            } else {
                $loads = 0;
            }

            $stmt = $db->connection->prepare("SELECT id, user_id, dates, times, citys, codes, countrys, daed, timed, cityd, coded, countryd, trailer, weight, distance, payrate, currency, rate_per_km, description FROM vehicles WHERE reserved_by = :user");
            $stmt->execute(['user' => $user]);
            if ($stmt->rowCount() > 0) {
                $vehicles = $stmt->fetchAll();
            } else {
                $vehicles = 0;
            }

            require_once PATH . 'app/Views/offers.view.php';
            $info = new Notify();
            $info->Info('You have successfully canceled vehicle order.');

        } elseif ($_GET['action'] == "load-edit") {

            $id = $_GET['id'];
            $user = $_SESSION['id'];

            $stmt = $db->connection->prepare("SELECT * FROM loads WHERE id = :id");
            $stmt->execute(['id' => $id]);
            $load = $stmt->fetch();

            if ($load['user_id'] == $user) {
                require_once PATH . 'app/Views/edit-load.view.php';
            } else {

                $stmt = $db->connection->prepare("SELECT id, user_id, dates, times, citys, codes, countrys, dated, timed, cityd, coded, countryd, trailer, weight, distance, payrate, currency, rate_per_km, description FROM loads WHERE user_id = :user");
                $stmt->execute(['user' => $user]);
                if ($stmt->rowCount() > 0) {
                    $loads = $stmt->fetchAll();
                } else {
                    $loads = 0;
                }

                $stmt = db->connection->prepare("SELECT id, user_id, dates, times, citys, codes, countrys, dated, timed, cityd, coded, countryd, trailer, weight, distance, payrate, currency, rate_per_km, description FROM vehicles WHERE user_id = :user");
                $stmt->execute(['user' => $user]);
                if ($stmt->rowCount() > 0) {
                    $vehicles = $stmt->fetchAll();
                } else {
                    $vehicles = 0;
                }

                require_once PATH . 'app/Views/offers.view.php';
                $error = new Notify();
                $error->Error('The page doesn\'t exist.');
            }

        } elseif ($_GET['action'] == "vehicle-edit") {
            $db = new Database();
            $id = $_GET['id'];
            $user = $_SESSION['id'];

            $stmt = $db->connection->prepare("SELECT * FROM vehicles WHERE id = :id");
            $stmt->execute(['id' => $id]);
            $vehicle = $stmt->fetch();

            if ($vehicle['user_id'] == $user) {
                require_once PATH . 'app/Views/edit-vehicle.view.php';
            } else {

                $stmt = $db->connection->prepare("SELECT id, user_id, dates, times, citys, codes, countrys, dated, timed, cityd, coded, countryd, trailer, weight, distance, payrate, currency, rate_per_km, description FROM loads WHERE user_id = :user");
                $stmt->execute(['user' => $user]);
                if ($stmt->rowCount() > 0) {
                    $loads = $stmt->fetchAll();
                } else {
                    $loads = 0;
                }

                $stmt = $db->connection->prepare("SELECT id, user_id, dates, times, citys, codes, countrys, dated, timed, cityd, coded, countryd, trailer, weight, distance, payrate, currency, rate_per_km, description FROM vehicles WHERE user_id = :user");
                $stmt->execute(['user' => $user]);
                if ($stmt->rowCount() > 0) {
                    $vehicles = $stmt->fetchAll();
                } else {
                    $vehicles = 0;
                }

                require_once PATH . 'app/Views/offers.view.php';
                $error = new Notify();
                $error->Error('The page doesn\'t exist.');

            }
        }
    }

    if (($_SERVER['REQUEST_METHOD'] == 'POST') && (isset($_GET['action']))) {

        if ($_GET['action'] == "update-load") {

            $id = $_GET['id'];

            $db = new Database();
            $allowedFields = ['places', 'countrys', 'citys', 'codes', 'streets', 'dates', 'times', 'placed', 'countryd', 'cityd', 'coded', 'streetd', 'dated', 'timed', 'weight', 'type_of_good', 'number_of_package', 'type_of_package', 'payrate', 'currency', 'distance', 'rate_per_km', 'trailer', 'description', 'reserved', 'reserved_by', 'description'];
            $mandatory = ['places', 'countrys', 'citys', 'codes', 'dates', 'times', 'placed', 'countryd', 'cityd', 'coded', 'dated', 'timed', 'weight', 'payrate', 'currency', 'distance', 'rate_per_km', 'trailer'];
            $dataToInsert = [];

            foreach ($allowedFields as $field) {
                if (!empty($_POST[$field])) {
                    $dataToInsert[$field] = $_POST[$field];
                } elseif (in_array($field, $mandatory)) {
                    die("Error: Mandatory field '$field' is required");
                }
            }

            $update_string = '';

            foreach ($dataToInsert as $field => $value) {
                $update_string .= $field . '=:' . $field . ', ';
            }
            $update_string = rtrim($update_string, ', ');

            $sql = "UPDATE loads SET $update_string WHERE id = :id";
            $stmt = $db->connection->prepare($sql)->execute(['id' => $id]);
            header('Location: ./offers?load=updated');

        } elseif ($_GET['action'] == "update-vehicle") {

            $id = $_GET['id'];

            $db = new Database();
            $allowedFields = ['places', 'countrys', 'citys', 'codes', 'streets', 'dates', 'times', 'placed', 'countryd', 'cityd', 'coded', 'streetd', 'dated', 'timed', 'weight', 'type_of_good', 'number_of_package', 'type_of_package', 'payrate', 'currency', 'distance', 'rate_per_km', 'trailer', 'description', 'reserved', 'reserved_by', 'description'];
            $mandatory = ['places', 'countrys', 'citys', 'codes', 'dates', 'times', 'weight', 'currency', 'rate_per_km', 'trailer'];
            $dataToInsert = [];

            foreach ($allowedFields as $field) {
                if (!empty($_POST[$field])) {
                    $dataToInsert[$field] = $_POST[$field];
                } elseif (in_array($field, $mandatory)) {
                    die("Error: Mandatory field '$field' is required");
                }
            }

            $update_string = '';

            foreach ($dataToInsert as $field => $value) {
                $update_string .= $field . '=:' . $field . ', ';
            }
            $update_string = rtrim($update_string, ', ');

            $sql = "UPDATE vehicles SET $update_string WHERE id = :id";
            $stmt = $db->connection->prepare($sql)->execute(['id' => $id]);
            header('Location: ./offers?vehicle=updated');
        }
    }

    if ((isset($_SESSION["id"])) && (!isset($_GET["action"]))) {

        $user = $_SESSION["id"];
        $db = new Database();

        $stmt = $db->connection->prepare("SELECT id, user_id, dates, times, citys, codes, countrys, dated, timed, cityd, coded, countryd, trailer, weight, distance, payrate, currency, rate_per_km, description FROM loads WHERE user_id = :user");
        $stmt->execute(['user' => $user]);
        if ($stmt->rowCount() > 0) {
            $loads = $stmt->fetchAll();
        } else {
            $loads = 0;
        }

        $stmt = $db->connection->prepare("SELECT id, user_id, dates, times, citys, codes, countrys, dated, timed, cityd, coded, countryd, trailer, weight, distance, payrate, currency, rate_per_km, description FROM vehicles WHERE user_id = :user");
        $stmt->execute(['user' => $user]);
        if ($stmt->rowCount() > 0) {
            $vehicles = $stmt->fetchAll();
        } else {
            $vehicles = 0;
        }
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
    header('Location: ./?url=invalid');
}
