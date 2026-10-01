<?php

namespace App\Tests;

use PHPUnit\Framework\TestCase;

class RequestTest extends TestCase
{
    public function testRequest(): void
    {
        $client = new \GuzzleHttp\Client();
        $response = $client->request('GET', 'http://127.0.0.1:8000/');
        $response2 = $client->request('GET', 'http://127.0.0.1:8000/register');
        $response3 = $client->request('GET', 'http://127.0.0.1:8000/forgot-password');
        $response4 = $client->request('GET', 'http://127.0.0.1:8000/example', ['http_errors' => false,]);
        $response5 = $client->request('GET', 'http://127.0.0.1:8000/logout');
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals(200, $response2->getStatusCode());
        $this->assertEquals(200, $response3->getStatusCode());
        $this->assertEquals(404, $response4->getStatusCode());
        $this->assertEquals(200, $response5->getStatusCode());

        $html = $response5->getBody()->getContents();
        $this->assertStringContainsString('You have been successfully logged out.', $html);
    }
}