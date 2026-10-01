<?php

namespace App\Actions\Load;

use App\Classes\Database;

class DeleteLoad
{
    private Database $db;

    public function __construct(Database $db)
    {
        $this->db = $db;
    }

    public function __invoke(int $id)
    {
            $stmt = $this->db->connection->prepare("DELETE FROM loads WHERE id = :id");
            $status = $stmt = $stmt->execute(['id' => $id]);   

        return $status;
    }
}