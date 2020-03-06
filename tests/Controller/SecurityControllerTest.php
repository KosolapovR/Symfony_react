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
        $this->assertSame('kosolapov', $response_data['username']);
    }
}