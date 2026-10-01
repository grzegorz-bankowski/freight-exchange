<?php

namespace App\Actions\Vehicle;

use App\Classes\Database;

class AddVehicle
{
    private Database $db;

    public function __construct(Database $db)
    {
        $this->db = $db;
    }

    public function __invoke(int $id)
    {
        $allowedFields = ['places', 'countrys', 'citys', 'codes', 'streets', 'dates', 'times', 'placed', 'countryd', 'cityd', 'coded', 'streetd', 'dated', 'timed', 'weight', 'type_of_good', 'number_of_package', 'type_of_package', 'payrate', 'currency', 'distance', 'rate_per_km', 'trailer', 'description', 'reserved', 'reserved_by'];
        $mandatory = ['places', 'countrys', 'citys', 'codes', 'dates', 'times', 'weight', 'currency', 'rate_per_km', 'trailer'];
        $dataToInsert = [];
        $dataToInsert['user_id'] = $id;

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
        $stmt = $this->db->connection->prepare($sql);
        $status = $stmt->execute(array_values($dataToInsert));
        if ($status) {
            return true;
        } else {
            return false;
        }
    }
}