<?php

namespace Controllers;

use App\Classes\Database;
use App\Classes\Notify;

session_start();

if (isset($_SESSION['id'])) {

    if (($_SERVER["REQUEST_METHOD"] == "POST") && ($_POST["action"] == "update")) {
        $db = new Database();
        $user = $_SESSION['id'];
        $name = $_POST["name"];
        $street = $_POST["street"];
        $city = $_POST["city"];
        $code = $_POST["code"];
        $country = $_POST["country"];
        $vat = $_POST["vat"];
        $phone = $_POST["phone"];
        $website = $_POST["website"];

        $stmt = $db->connection->prepare("UPDATE users SET name = :name,  street = :street, city = :city, code = :code, country = :country, vat = :vat, phone = :phone, website = :website WHERE id = :user");
        $stmt->execute(["name" => $name, "street" => $street, "city" => $city, "code" => $code, "country" => $country, "vat" => $vat, "phone" => $phone, "website" => $website, "user" => $user]);

        $_SESSION['name'] = $name;
        $_SESSION['street'] = $street;
        $_SESSION['city'] = $city;
        $_SESSION['code'] = $code;
        $_SESSION['country'] = $country;
        $_SESSION['vat'] = $vat;
        $_SESSION['phone'] = $phone;
        $_SESSION['website'] = $website;

        require_once PATH . 'app/Views/profile.view.php';
        $info = new Notify();
        $info->Info('Your account has been updated.');
    }

    if ($_SERVER["REQUEST_METHOD"] == "GET") {
        require_once PATH . 'app/Views/profile.view.php';
    }

} else {
    header('Location: ./?url=invalid');
}
