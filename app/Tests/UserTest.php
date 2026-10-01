<?php

namespace App\Tests;

require_once __DIR__ . '/../../vendor/autoload.php';

use \PDO;
use App\Classes\Database;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    public function testCreateUser(): void
    {
        $email = 'g.bankowski@wp.pl';
        $password = 'Symfony2026#$%';
        $this->cleanTable('users');

        //Does the registration page open and have the correct header?

        $client = new \GuzzleHttp\Client();
        $response = $client->request('GET', 'http://127.0.0.1:8000/register');
        $this->assertEquals(200, $response->getStatusCode());
        $html = $response->getBody()->getContents();
        $this->assertStringContainsString('<h1>Create a new account</h1>', $html);

        $response2 = $client->request('POST', 'http://127.0.0.1:8000/register', [
            'form_params' => [
                'email' => $email,
                'password' => $password,
            ]
        ]);
        $this->assertEquals('200', $response2->getStatusCode());
        $html2 = $response2->getBody()->getContents();
        $this->assertStringContainsString('Your account has been created. You can now sign in.', $html2);

        //Does the databsse has exactly only one user record?

        $db = new Database();
        $sql = "SELECT COUNT(*) AS TOTAL FROM users";
        $stmt = $db->connection->prepare($sql);
        $count = $stmt->execute();
        $this->assertEquals(1, $count, "In the database should be exactly only one user.");

        //Does the user record has the correct email address & password values? Is the password hashed?

        $sql = "SELECT * FROM users WHERE email = '$email'";
        $stmt = $db->connection->prepare($sql);
        $user = $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        $this->assertNotEmpty($user, "The user with the specified email address should exist in the database.");
        $this->assertNotEquals($password, $user['password'], "The password should not be stored in plain text.");
        $this->assertTrue(password_verify($password, $user['password']), "The password has not been hashed correctly.");
    }

    //Delete the records from my database table before starting the tests

    public function cleanTable(string $table): void
    {
        $db = new Database();
        $sql = 'DELETE FROM ' . $table;
        $sql2 = 'ALTER TABLE ' . $table . ' AUTO_INCREMENT = 1';
        $stmt = $db->connection->prepare($sql);
        $stmt2 = $db->connection->prepare($sql2);
        $stmt->execute();
        $stmt2->execute();
    }
}