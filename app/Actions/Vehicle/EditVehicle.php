<?php

namespace App\Actions\Vehicle;

use App\Classes\Database;

class EditVehicle
{
    private Database $db;

    public function __construct(Database $db)
    {
        $this->db = $db;
    }

    public function __invoke(int $id, int $user)
    {
        $stmt = $this->db->connection->prepare("SELECT * FROM vehicles WHERE id = :id");
        $stmt->execute(['id' => $id]);
        $vehicle = $stmt->fetch();
        if ($vehicle['user_id'] == $user) {
            $status = true;
        } else {
            $status = false;
        }

        return [
            'status' => $status,
            'vehicle' => $vehicle
        ];
    }
}