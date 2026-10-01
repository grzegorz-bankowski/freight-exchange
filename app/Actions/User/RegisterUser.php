<?php

namespace App\Actions\User;

use App\Classes\Database;
use App\Classes\Validator;

class RegisterUser
{
    private Database $db;

    public function __construct(Database $db)
    {
        $this->db = $db;
    }

    public function __invoke(string $email, string $password)
    {
        $email_check = new Validator();
        $email_check = $email_check->validateEmail(trim($email));
        $password_check = new Validator();
        $password_check = $password_check->validatePassword($password);
        if ($email_check && $password_check) {
            $password = password_hash($password, PASSWORD_DEFAULT);
            $stmt = $this->db->connection->prepare("INSERT INTO users (email, password) VALUES (:email, :password)");
            $stmt->execute(['email' => $email, 'password' => $password]);
            if ($stmt->rowCount() > 0) {
                require_once __DIR__ . '/../../../app/Controllers/send-email.php';
                $status = true;
            } else {
                $status = 'error';
            }
        } else {
            $status = 'invalid';
        }
        return $status;
    }
}