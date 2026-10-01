<?php

namespace App\Controllers;

use App\Actions\Load\PreviewLoad;

session_start();

if (isset($_SESSION['id'])) {
    $id = $_GET['id'];

    $preview = new PreviewLoad($db);
    $array = $preview($id);
    $load = $array['load'];
    $status = $array['status'];
    $addresses = [
        $array['origin'],
        $array['destination']
    ];
    if ($status) {
        require_once PATH . 'app/Views/load.view.php';
    }
} else {
    header('Location: ./?a=invalid');
}