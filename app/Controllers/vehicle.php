<?php

namespace Controllers;

require_once "../Classes/Database.php";

use App\Classes\Database;

session_start();

if (isset($_SESSION['id']) && ($_GET["action"] == "more")) {
    $db = new Database();
    $id = $_GET['id'];
    $stmt = $db->connection->prepare("SELECT vehicles.id, vehicles.user_id, vehicles.places, DATE_FORMAT(vehicles.dates, '%d-%m-%Y') AS formatted_dates, DATE_FORMAT(vehicles.dates, '%H:%i') AS formatted_times, vehicles.streets, vehicles.citys, vehicles.codes, vehicles.countrys, DATE_FORMAT(vehicles.dated, '%d-%m-%Y') AS formatted_dated, DATE_FORMAT(vehicles.dated, '%H:%i') AS formatted_timed, vehicles.placed, vehicles.cityd, vehicles.coded, vehicles.streetd, vehicles.countryd, vehicles.trailer, vehicles.weight, vehicles.type_of_good, vehicles.number_of_package, vehicles.type_of_package, vehicles.distance, vehicles.payrate, vehicles.currency, vehicles.rate_per_km, vehicles.description, users.phone, users.email, users.website FROM vehicles INNER JOIN users ON vehicles.user_id = users.id WHERE vehicles.id = :id");
    $stmt->execute([':id' => $id]);
    $vehicle = $stmt->fetch();
    $origin = $vehicle['codes'] . " " . $vehicle['citys'] . $vehicle['countrys'];
    require_once '../Views/vehicle.view.php';
} elseif (isset($_SESSION['id']) && ($_GET["action"] == "reserve")) {
    $db = new Database();
    $id = $_GET['id'];
    $user = $_SESSION['id'];
    $stmt = $db->connection->prepare("UPDATE vehicles SET reserve = :reserve, reserved_by = :user WHERE id = :id");
    $stmt->execute([':reserve' => 'yes', ':user' => $user, ':id' => $id]);
    header('Location: ./orders?vehicle=reserved');
} else {
    header('Location: ./?url=invalid');
}
