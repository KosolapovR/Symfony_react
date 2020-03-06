<?php


namespace App\Tests\Controller;


use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class CommentControllerTest extends WebTestCase
{
    public function testGetAllCommentAction(){
        $client = static::createClient();
        $client->request('GET', '/api/comment');
        $this->assertResponseStatusCodeSame(200);
    }

    public function testGetCommentAction(){
        $client = static::createClient();
        $client->request('GET', '/api/comment/10');
        $response = $client->getResponse();
        $this->assertResponseStatusCodeSame(200);
        $response_data = json_decode($response->getContent(), true);
        $this->assertSame(10, $response_data['id']);
    }

    public function testPostCommentAction(){
        $content = [
            'user_id' => '7',
            'post_id' => '8',
            'text' => 'some comment text'
        ];

        $client = static::createClient();
        $client->request('POST', '/api/comment', $content);
        $response = $client->getResponse();

        $this->assertResponseStatusCodeSame(201);
        $json = json_decode($response->getContent(), true);
        $data = json_decode($json, true);

        $this->assertEquals('8', $data['post']['id']);
        $this->assertEquals('7', $data['user']['id']);
        $this->assertEquals('some comment text', $data['text']);
    }

    public function testDeleteCommentAction(){
        $client = static::createClient();

        $client->request('DELETE', '/api/comment/1111111');
        $this->assertResponseStatusCodeSame(404);

        $client->request('DELETE', '/api/comment/10');
        $this->assertResponseStatusCodeSame(200);
    }
}