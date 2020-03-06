<?php


namespace App\Tests\Controller;


use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class PostControllerTest extends WebTestCase
{
    public function testGetAllPostAction(){
        $client = static::createClient();
        $client->request('GET', '/api/post');
        $this->assertResponseStatusCodeSame(200);
    }

    public function testGetPostAction(){
        $client = static::createClient();
        $client->request('GET', '/api/post/10');
        $response = $client->getResponse();
        $this->assertResponseStatusCodeSame(200);
        $response_data = json_decode($response->getContent(), true);
        $this->assertSame(10, $response_data['id']);
    }

    public function testPostPostAction(){
        $content = [
            'text' => 'Some text',
        ];

        $client = static::createClient();
        $client->request('POST', '/api/post', $content);
        $response = $client->getResponse();

        $this->assertResponseStatusCodeSame(201);
        $data = json_decode($response->getContent(), true);
        $data = json_decode($data, true);

        $this->assertEquals('Some text', $data['text']);
    }

    public function testDeletePostAction(){
        $client = static::createClient();

        $client->request('DELETE', '/api/post/1111111');
        $this->assertResponseStatusCodeSame(404);

        $client->request('DELETE', '/api/post/10');
        $this->assertResponseStatusCodeSame(200);
    }
}