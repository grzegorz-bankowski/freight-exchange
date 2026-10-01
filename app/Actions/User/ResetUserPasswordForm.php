<?php

namespace App\Actions\User;

use App\Classes\Database;

class ResetUserPasswordForm
{
    private Database $db;

    public function __construct(Database $db)
    {
        $this->db = $db;
    }

    public function __invoke(string $token)
    {
        $stmt = $this->db->connection->prepare("SELECT * FROM users WHERE token = :token");
        $stmt->execute([':token' => $token]);
        if ($stmt->rowCount() > 0) {
            $status = true;
        } else {
            $status = false;
        }
        return $status;
    }
}