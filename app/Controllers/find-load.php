<?php

namespace App\Controllers;

use App\Classes\Database;

session_start();

if (isset($_SESSION['id']) && ($_SERVER['REQUEST_METHOD'] == 'GET')) {
    $user = $_SESSION['id'];
    $db = new Database();
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

    $stmt = $db->connection->prepare("SELECT id, user_id, dates, times, citys, codes, countrys, dated, timed, streetd, cityd, coded, countryd, trailer, weight, distance, payrate, currency, rate_per_km, description FROM loads WHERE reserved = :no AND countrys LIKE :origin AND citys LIKE :start_city AND countryd LIKE :destination AND cityd LIKE :end_city AND trailer LIKE :trailer AND NOT user_id = :user AND weight BETWEEN :weight_min AND :weight_max LIMIT :limit OFFSET :offset");
    $stmt->execute(['no', "%$origin", "%$start_city", "%$destination", "%$end_city", "%$trailer%", $user, $weight_min, $weight_max, $limit, $offset]);
    if ($stmt->rowCount() > 0) {
        $loads = $stmt->fetchAll();
    } else {
        $loads = 0;
    }

    $stmt2 = $db->connection->prepare("SELECT COUNT(id) FROM loads WHERE reserved = :no AND countrys LIKE :origin AND citys LIKE :start_city AND countryd LIKE :destination AND cityd LIKE :end_city AND trailer LIKE :trailer AND NOT user_id = :user AND weight BETWEEN :weight_min AND :weight_max");
    $stmt2->execute(['no', "%$origin", "%$start_city", "%$destination", "%$end_city", "%$trailer%", $user, $weight_min, $weight_max]);
    if ($stmt2->rowCount() > 0) {
        $total = $stmt2->fetchColumn();
    } else {
        $total = 0;
    }
    require_once PATH . 'app/Views/find-load.view.php';
} else {
    header('Location: ./?url=invalid');
}
