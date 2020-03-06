<?php


namespace App\Tests\Controller;


use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class LikesControllerTest extends WebTestCase
{
    public function testGetAllLikesAction()
    {
        $client = static::createClient();
        $client->request('GET', '/api/likes');
        $this->assertResponseStatusCodeSame(200);
    }

    public function testGetLikesAction()
    {
        $client = static::createClient();
        $client->request('GET', '/api/likes/10');
        $response = $client->getResponse();
        $this->assertResponseStatusCodeSame(200);
        $response_data = json_decode($response->getContent(), true);
        $this->assertSame(10, $response_data['id']);
    }

    public function testPostLikesAction()
    {
        $content = [
            'user_id' => '7',
            'post_id' => '8',
        ];

        $client = static::createClient();
        $client->request('POST', '/api/likes', $content);
        $response = $client->getResponse();

        $this->assertResponseStatusCodeSame(201);
        $json = json_decode($response->getContent(), true);
        $data = json_decode($json, true);

        $this->assertEquals('8', $data['post']['id']);
        $this->assertEquals('7', $data['user']['id']);
    }

    public function testDeleteLikesAction()
    {
        $client = static::createClient();

        $client->request('DELETE', '/api/likes/1111111');
        $this->assertResponseStatusCodeSame(404);

        $client->request('DELETE', '/api/likes/10');
        $this->assertResponseStatusCodeSame(200);
    }
}