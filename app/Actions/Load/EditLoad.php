<?php

namespace App\Actions\Load;

use App\Classes\Database;

class EditLoad
{
    private Database $db;

    public function __construct(Database $db)
    {
        $this->db = $db;
    }

    public function __invoke(int $id, int $user)
    {
        $stmt = $this->db->connection->prepare("SELECT * FROM loads WHERE id = :id");
        $stmt->execute(['id' => $id]);
        $load = $stmt->fetch();
        if ($load['user_id'] == $user) {
            $status = true;
        } else {
            $status = false;
        }

        return [
            'status' => $status,
            'load' => $load
        ];
    }
}