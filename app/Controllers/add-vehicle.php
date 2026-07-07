<?php

namespace App\Controllers;

use App\Classes\Database;

session_start();

$_POST['places'] = isset($_POST['places']) ? $_POST['places'] : '';
$_POST['countrys'] = isset($_POST['countrys']) ? $_POST['countrys'] : '';
$_POST['countryd'] = isset($_POST['countryd']) ? $_POST['countryd'] : '';
$_POST['type_of_package'] = isset($_POST['type_of_package']) ? $_POST['type_of_package'] : '';
$_POST['trailer'] = isset($_POST['trailer']) ? $_POST['trailer'] : '';
$_POST['currency'] = isset($_POST['currency']) ? $_POST['currency'] : '';

if (isset($_SESSION['id'])) {

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $user = $_SESSION['id'];
        $db = new Database();

        $allowedFields = ['places', 'countrys', 'citys', 'codes', 'streets', 'dates', 'times', 'placed', 'countryd', 'cityd', 'coded', 'streetd', 'dated', 'timed', 'weight', 'type_of_good', 'number_of_package', 'type_of_package', 'payrate', 'currency', 'distance', 'rate_per_km', 'trailer', 'description', 'reserved', 'reserved_by'];
        $mandatory = ['places', 'countrys', 'citys', 'codes', 'dates', 'times', 'weight', 'currency', 'rate_per_km', 'trailer'];
        $dataToInsert = [];
        $dataToInsert['user_id'] = $user;

        foreach ($allowedFields as $field) {
            if (!empty($_POST[$field])) {
                $dataToInsert[$field] = $_POST[$field];
            } elseif (in_array($field, $mandatory)) {
                die("Error: Mandatory field '$field' is required");
            }
        }

        $columns = implode(', ', array_keys($dataToInsert));
        $placeholders = implode(', ', array_fill(0, count($dataToInsert), '?'));
        $sql = "INSERT INTO vehicles ($columns) VALUES ($placeholders)";
        $stmt = $db->connection->prepare($sql);
        $stmt->execute(array_values($dataToInsert));
        header('Location: ./offers?vehicle=add');
    }

    if ($_SERVER["REQUEST_METHOD"] == "GET") {
        require_once PATH . 'app/Views/add-vehicle.view.php';
    }

} else {
    header('Location: ./?url=invalid');
}
