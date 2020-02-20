<?php


namespace App\Tests\Controller;


use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class MessageControllerTest extends WebTestCase
{
    public function testGetAllMessageAction()
    {
        $clinet = static::createClient();
        $clinet->request('GET', '/api/message');
        $this->assertResponseStatusCodeSame(200);
    }

    public function testGetMessageAction()
    {
        $clinet = static::createClient();
        $clinet->request('GET', '/api/message/10');
        $response = $clinet->getResponse();
        $this->assertResponseStatusCodeSame(200);
        $response_data = json_decode($response->getContent(), true);
        $this->assertSame(10, $response_data['id']);
    }

    public function testPostMessageAction()
    {
        $content = [
            'user_id' => '7',
        ];

        $client = static::createClient();
        $client->request('POST', '/api/message', $content);
        $response = $client->getResponse();

        $this->assertResponseStatusCodeSame(201);
        $json = json_decode($response->getContent(), true);
        $data = json_decode($json, true);

        $this->assertEquals('7', $data['user']['id']);
    }

    public function testDeleteMessageAction()
    {
        $client = static::createClient();

        $client->request('DELETE', '/api/message/1');
        $this->assertResponseStatusCodeSame(404);

        $client->request('DELETE', '/api/message/10');
        $this->assertResponseStatusCodeSame(200);
    }
}