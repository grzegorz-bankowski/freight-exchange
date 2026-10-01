<?php

namespace App\Actions\User;

use App\Classes\Database;
use App\Classes\Validator;

class ForgotUserPassword
{
    private Database $db;

    public function __construct(Database $db)
    {
        $this->db = $db;
    }

    public function __invoke(string $email)
    {
        if ($email != '') {
            $validator = new Validator();
            $validator = $validator->validateEmail($email);
            if($validator) {
                $stmt = $this->db->connection->prepare("SELECT * FROM users WHERE email = :email");
                $stmt->execute(['email' => $email]);
                if ($stmt->rowCount() > 0) {
                    $token = bin2hex(random_bytes(16));
                    $sql = "UPDATE users SET token = :token WHERE email = :email";
                    $stmt = $this->db->connection->prepare($sql)->execute(["token" => $token, "email" => $email]);
                    require_once __DIR__ . '/../../../app/Controllers/send-token.php';
                    $mail->addAddress($email);
                    $status = $mail->send();
                } else {
                    $status = 'none';
                }
            } else {
                $status = 'invalid';
            }
        } else {
            $status ='empty';
        }
    return $status;
    }
}