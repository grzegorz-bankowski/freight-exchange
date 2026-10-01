<?php

namespace App\Actions\User;

use App\Classes\Database;

class UpdateUserProfile
{
    private Database $db;

    public function __construct(Database $db)
    {
        $this->db = $db;
    }

    public function __invoke(int $id)
    {
        $name = $_POST["name"];
        $street = $_POST["street"];
        $city = $_POST["city"];
        $code = $_POST["code"];
        $country = $_POST["country"];
        $vat = $_POST["vat"];
        $phone = $_POST["phone"];
        $website = $_POST["website"];

        $stmt = $this->db->connection->prepare("UPDATE users SET name = :name,  street = :street, city = :city, code = :code, country = :country, vat = :vat, phone = :phone, website = :website WHERE id = :id");
        $status = $stmt->execute(["name" => $name, "street" => $street, "city" => $city, "code" => $code, "country" => $country, "vat" => $vat, "phone" => $phone, "website" => $website, "id" => $id]);

        $_SESSION['name'] = $name;
        $_SESSION['street'] = $street;
        $_SESSION['city'] = $city;
        $_SESSION['code'] = $code;
        $_SESSION['country'] = $country;
        $_SESSION['vat'] = $vat;
        $_SESSION['phone'] = $phone;
        $_SESSION['website'] = $website;

        if ($status) {
            return true;
        } else {
            return false;
        }
    }
}