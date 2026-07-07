<?php

namespace App\Controllers;

use App\Classes\Database;

session_start();

if (isset($_SESSION['id']) && ($_GET["action"] == "more")) {
    $db = new Database();
    $id = $_GET['id'];

    $stmt = $db->connection->prepare("SELECT loads.id, loads.user_id, loads.dates, loads.times, loads.places, loads.streets, loads.citys, loads.codes, loads.countrys, loads.dated, loads.timed, loads.placed, loads.streetd, loads.cityd, loads.coded, loads.countryd, loads.trailer, loads.weight, loads.type_of_good, loads.number_of_package, loads.type_of_package, loads.distance, loads.payrate, loads.currency, loads.rate_per_km, loads.description, users.phone, users.email, users.website FROM loads INNER JOIN users ON loads.user_id = users.id WHERE loads.id = :id");
    $stmt->execute(array("id" => $id));
    $load = $stmt->fetch();
    $origin = $load['streets'] . ", " . $load['codes'] . " " . $load['citys'];
    $destination = $load['streetd'] . ", " . $load['coded'] . " " . $load['cityd'];
    $addresses = [
        $origin,
        $destination
    ];
    require_once PATH . 'app/Views/load.view.php';
} elseif (isset($_SESSION['id']) && ($_GET["action"] == "reserve")) {
    $db = new Database();
    $id = $_GET['id'];
    $user = $_SESSION['id'];

    $stmt = $db->connection->prepare("UPDATE loads SET reserved = :yes,  reserved_by = :user WHERE id = :id");
    $stmt->execute(array("yes" => 'yes', "id" => $id, "user" => $user));

    header('Location: ./orders?load=reserved');
} else {
    header('Location: ./?url=invalid');
}