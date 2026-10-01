<?php

namespace App\Actions\User;

use App\Classes\Database;

class DeleteUser
{
    private Database $db;

    public function __construct(Database $db)
    {
        $this->db = $db;
    }

    public function __invoke(int $id, string $password)
    {
        $stmt = $this->db->connection->prepare("SELECT password FROM users WHERE id = :id");
        $stmt->execute([':id' => $id]);
        $current = $stmt->fetch();
            if (password_verify($password, $current['password'])) {
                $stmt = $this->db->connection->prepare("DELETE FROM users WHERE id = :id");
                $status = $stmt->execute([':id' => $id]);
                $_SESSION = [];
                session_destroy();
            } else {
                $status = false;
            }
        return $status;
    }
}