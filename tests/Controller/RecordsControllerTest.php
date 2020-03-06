<?php


namespace App\Tests\Controller;


use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class RecordsControllerTest extends WebTestCase
{
    public function testGetAllRecordsAction(){
        $client = static::createClient();
        $client->request('GET', '/api/records');
        $this->assertResponseStatusCodeSame(200);
    }

    public function testGetRecordsAction(){
        $client = static::createClient();
        $client->request('GET', '/api/records/10');
        $response = $client->getResponse();
        $this->assertResponseStatusCodeSame(200);
        $response_data = json_decode($response->getContent(), true);
        $this->assertSame(10, $response_data['id']);
    }

    public function testPostRecordsAction(){
        $content = [
            'user_id' => '7',
            'category_id' => '10'
        ];

        $client = static::createClient();
        $client->request('POST', '/api/records', $content);
        $response = $client->getResponse();

        $this->assertResponseStatusCodeSame(201);
        $json = json_decode($response->getContent(), true);
        $data = json_decode($json, true);

        $this->assertEquals('10', $data['category']['id']);
        $this->assertEquals('7', $data['User']['id']);

    }

    public function testDeleteRecordsAction(){
        $client = static::createClient();

        $client->request('DELETE', '/api/records/1111111');
        $this->assertResponseStatusCodeSame(404);

        $client->request('DELETE', '/api/records/10');
        $this->assertResponseStatusCodeSame(200);
    }
}