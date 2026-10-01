<?php

namespace App\Actions\Load;

use App\Classes\Database;

class CancelLoad
{
    private Database $db;

    public function __construct(Database $db)
    {
        $this->db = $db;
    }
    public function __invoke(int $id)
    {
        $sql = "UPDATE loads SET reserved = ?,  reserved_by = ? WHERE id = ?";
        $this->db->connection->prepare($sql)->execute(['no', 0, $id]);
    }
}