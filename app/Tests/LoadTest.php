<?php

namespace App\Tests;

require_once __DIR__ . '/../../vendor/autoload.php';

use \PDO;
use App\Classes\Database;
use PHPUnit\Framework\TestCase;

class LoadTest extends TestCase
{
    //Does user can log in and see correct header value?
    public function testLoginAsUser(): void
    {
        $email = 'user@email.com';
        $password = 'UserPassword';
        $client = new \GuzzleHttp\Client();
        $response = $client->request('POST', 'http://127.0.0.1:8000/orders', [
            'form_params' => [
                'email' => $email,
                'password' => $password,
                'action' => 'login'
            ]
        ]);
        
        $this->assertEquals(200, $response->getStatusCode());
        $html = $response->getBody()->getContents();
        $this->assertStringContainsString('Your load orders', $html);
    }

    //Does user can view "Add load" page?
    public function testUserCanSeeAddLoadForm(): void
    {
        $client = new \GuzzleHttp\Client();
        $response2 = $client->request('GET', 'http://127.0.0.1:8000/add-load', [
            'headers' => [
                'X-Test-Env' => getenv('APP_ENV') // Pobiera wartość z phpunit.xml
            ]
        ]);
        $this->assertEquals(200, $response2->getStatusCode());
        $html = $response2->getBody()->getContents();
        $this->assertStringContainsString('<form action="./add-load" method="post" class="form">', $html);
    }

    //Does user can add load to database and then there is only this one record?
    public function testUserCanAddLoad(): void
    {
        $client = new \GuzzleHttp\Client();
        $response3 = $client->request('GET', 'http://127.0.0.1:8000/add-load', [
            'query' => [
                'test_user_id' => 1
            ]
        ]);

        $this->cleanTable('loads');

        $response4 = $client->request('POST', 'http://127.0.0.1:8000/add-load', [
            'form_params' => [
                'places' => 'Electris',
                'countrys' => 'Poland',
                'citys' => 'Biała Podlaska',
                'codes' => '21-500',
                'streets' => 'Emilii Plater 6',
                'dates' => '2026-09-26',
                'times' => '06:00:00',
                'placed' => 'Agrostop',
                'countryd' => 'Poland',
                'cityd' => 'Małaszewicze Duże',
                'coded' => '21-550',
                'dated' => '2026-09-26',
                'timed' => '12:00:00',
                'weight' => 22050,
                'payrate' => 500,
                'currency' => 'PLN',
                'distance' => '50',
                'rate_per_km' => 10,
                'trailer' => 'Container'
            ],
            'headers' => [
                'X-Test-Env' => getenv('APP_ENV') // Pobiera wartość z phpunit.xml
            ]
        ]);

        $this->assertEquals(200, $response4->getStatusCode());
        $html = $response4->getBody()->getContents();
        $this->assertStringContainsString('Your load offer has been added.', $html);

        $db = new Database();
        $sql = "SELECT COUNT(*) AS TOTAL FROM loads";
        $stmt = $db->connection->prepare($sql);
        $count = $stmt->execute();
        $this->assertEquals(1, $count, "In the database should be exactly only one load offer.");

        $sql2 = "SELECT * FROM loads WHERE user_id = 1";
        $stmt = $db->connection->prepare($sql2);
        $offer = $stmt->execute();
        $offer = $stmt->fetch(PDO::FETCH_ASSOC);
        $this->assertNotEmpty($offer, "The one offer with the specified user id should exist in the database.");
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
