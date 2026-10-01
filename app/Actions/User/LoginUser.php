<?php

namespace App\Actions\User;

use App\Classes\Database;

class LoginUser
{
    private Database $db;

    public function __construct(Database $db)
    {
        $this->db = $db;
    }

    public function __invoke(string $email, string $password): bool
    {
        $stmt = $this->db->connection->prepare("SELECT * FROM users WHERE email = :email");
        $stmt->execute(['email' => $email]);
        $user = $stmt->fetch();
        $total = $stmt->rowCount();
        if ($total > 0) {
            if (password_verify($password, $user['password'])) {
                $_SESSION['id'] = $user['id'];
                $_SESSION['email'] = $user['email'];
                $_SESSION['name'] = $user['name'];
                $_SESSION['password'] = $user['password'];
                $_SESSION['street'] = $user['street'];
                $_SESSION['city'] = $user['city'];
                $_SESSION['code'] = $user['code'];
                $_SESSION['country'] = $user['country'];
                $_SESSION['vat'] = $user['vat'];
                $_SESSION['phone'] = $user['phone'];
                $_SESSION['website'] = $user['website'];
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
}