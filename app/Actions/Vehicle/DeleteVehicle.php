<?php

namespace App\Actions\Vehicle;

use App\Classes\Database;

class DeleteVehicle
{
    private Database $db;

    public function __construct(Database $db)
    {
        $this->db = $db;
    }

    public function __invoke(int $id)
    {
            $stmt = $this->db->connection->prepare("DELETE FROM vehicles WHERE id = :id");
            $status = $stmt = $stmt->execute(['id' => $id]);   

        return $status;
    }
}