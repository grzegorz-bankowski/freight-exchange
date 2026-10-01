<?php

namespace App\Actions\Vehicle;

use App\Classes\Database;

class UpdateVehicle
{
    private Database $db;

    public function __construct(Database $db)
    {
        $this->db = $db;
    }

    public function __invoke(int $id)
    {
        $allowedFields = ['places', 'countrys', 'citys', 'codes', 'streets', 'dates', 'times', 'placed', 'countryd', 'cityd', 'coded', 'streetd', 'dated', 'timed', 'weight', 'type_of_good', 'number_of_package', 'type_of_package', 'payrate', 'currency', 'distance', 'rate_per_km', 'trailer', 'description', 'reserved', 'reserved_by', 'description'];
        $mandatory = ['places', 'countrys', 'citys', 'codes', 'dates', 'times', 'weight', 'currency', 'rate_per_km', 'trailer'];
        $dataToInsert = [];
        $update_string = '';

        foreach ($allowedFields as $field) {
            if (!empty($_POST[$field])) {
                $dataToInsert[$field] = $_POST[$field];
            } elseif (in_array($field, $mandatory)) {
                die("Error: Mandatory field '$field' is required");
            }
        }

        foreach ($dataToInsert as $field => $value) {
            $update_string .= $field . '=:' . $field . ', ';
        }

        $update_string = rtrim($update_string, ', ');
        $stmt = $this->db->connection->prepare("UPDATE vehicles SET $update_string WHERE id = $id");
        $status = $stmt->execute($dataToInsert);

        return $status;
    }
}