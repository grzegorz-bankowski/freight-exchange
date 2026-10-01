<?php

namespace App\Actions\User;

use App\Classes\Database;
use App\Classes\Validator;

class ChangeUserEmail
{
    private Database $db;

    public function __construct(Database $db)
    {
        $this->db = $db;
    }

    public function __invoke(int $id, string $newemail)
    {
        $email = new Validator();
        $email = $email->validateEmail(trim($newemail));
        if ($email === true) {
            $stmt = $this->db->connection->prepare("UPDATE users SET email = :email WHERE id = :id");
            $status = $stmt->execute([':email' => $newemail, ':id' => $id]);
            $_SESSION['email'] = $newemail;    ;
        } else {
            $status = false;
        }
        return $status;
    }
}