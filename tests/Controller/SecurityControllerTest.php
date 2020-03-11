<?php


namespace App\Tests\Controller;


use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class SecurityControllerTest extends WebTestCase
{
    public function testLoginAction()
    {
        $client = static::createClient();

        $client->request('post', '/api/login',
            [],
            [],
            ['CONTENT_TYPE' => 'application/json'],
            '{"security" : {"credentials":{"email":"kosolapov-r@bk.ru", "password": "romul1991"}}}');

        $this->assertResponseStatusCodeSame(200);
        $response = $client->getResponse();
        $response_data = json_decode($response->getContent(), true);
        $this->assertArrayHasKey('token', $response_data);
        $this->assertEquals(1, count($response_data));
    }

    public function testInvalidCredentials()
    {
        $client = static::createClient();

        $client->request('post', '/api/login',
            [],
            [],
            ['CONTENT_TYPE' => 'application/json'],
            '{"security" : {"credentials":{"email":"dasfsdg-r@bk.ru", "password": "24tgsdf"}}}');

        $this->assertResponseStatusCodeSame(401);
        $response = $client->getResponse();
        $response_data = json_decode($response->getContent(), true);
        $this->assertArrayHasKey('message', $response_data);
        $this->assertEquals('Invalid credentials.', $response_data['message']);
    }
}