<?php

namespace App\Actions\User;

use App\Classes\Database;
use App\Classes\Validator;

class ChangeUserPassword
{
    private Database $db;

    public function __construct(Database $db)
    {
        $this->db = $db;
    }

    public function __invoke(int $id, string $newpassword)
    {
        $password = new Validator();
        $password = $password->validatePassword($newpassword);
        if ($password === true) {
            $password = password_hash($newpassword, PASSWORD_DEFAULT);
            $stmt = $this->db->connection->prepare("UPDATE users SET password = :password WHERE id = :id");
            $status = $stmt->execute([':password' => $password, ':id' => $id]);
        } else {
            $status = false;
        }
    return $status;
    }
}