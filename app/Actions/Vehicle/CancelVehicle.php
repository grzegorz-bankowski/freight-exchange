<?php

namespace App\Actions\Vehicle;

use App\Classes\Database;

class CancelVehicle
{
    private Database $db;

    public function __construct(Database $db)
    {
        $this->db = $db;
    }

    public function __invoke(int $id)
    {
        $db = new Database;
        $sql = "UPDATE vehicles SET reserved = ?,  reserved_by = ? WHERE id = ?";
        $stmt = $this->db->connection->prepare($sql)->execute(['no', 0, $id]);
    }
}