<?php

namespace App\Actions\User;

use App\Classes\Database;
use App\Classes\Validator;

class ResetUserPassword
{
    private Database $db;

    public function __construct(Database $db)
    {
        $this->db = $db;
    }

    public function __invoke(string $token, string $password)
    {
        $check = new Validator();
        $check = $check->validatePassword($password);
        if ($check) {
            $password = password_hash($password, PASSWORD_DEFAULT);
            $stmt = $this->db->connection->prepare("UPDATE users SET password = :password WHERE token = :token");
            $status = $stmt->execute([':token' => $token, ':password' => $password]);
        } else {
            $status = 'invalid';
        }

        return $status;
    }
}