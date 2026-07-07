<?php

namespace App\Classes;

class Validator
{
    public function validateEmail(string $email) : bool {
        $pattern = '/^(\w+\.)*\w+@(\w+\.)+[A-Za-z]{2,}/';
        $result = preg_match($pattern, $email);
        return $result;
    }

    public function validatePassword(string $password) : bool {
        $pattern = '/^(?=.{8,}$)(?=.*[A-Z])(?=.*[a-z])(?=.*[0-9])(?=.*[!@#$%]).*$/';
        $result = preg_match($pattern, $password);
        return $result;
    }
}