<?php

namespace App\Controllers;

use App\Actions\Load\AddLoad;
use App\Classes\Notify;

session_start();

$_POST['places'] = isset($_POST['places']) ? $_POST['places'] : '';
$_POST['countrys'] = isset($_POST['countrys']) ? $_POST['countrys'] : '';
$_POST['countryd'] = isset($_POST['countryd']) ? $_POST['countryd'] : '';
$_POST['type_of_package'] = isset($_POST['type_of_package']) ? $_POST['type_of_package'] : '';
$_POST['trailer'] = isset($_POST['trailer']) ? $_POST['trailer'] : '';
$_POST['currency'] = isset($_POST['currency']) ? $_POST['currency'] : '';

if (isset($_SESSION['id'])) {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $id = $_SESSION['id'];
        
        $load = new AddLoad($db);
        $status = $load($id);

        if ($status) {
            header('Location: ./offers?load=add');
        } else {
            require_once PATH . 'app/Views/add-load.view.php';
            $error = new Notify();
            $error->Error('We have problem with adding this load offer');
        }        
    }

    if ($_SERVER["REQUEST_METHOD"] == "GET") {
        require_once PATH . 'app/Views/add-load.view.php';
    }

} else {
    header('Location: ./?a=invalid');
}
