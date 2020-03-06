<?php


namespace App\Tests\Controller;


use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class CategoryControllerTest extends WebTestCase
{
    public function testGetAllCategoryAction()
    {
        $client = static::createClient();
        $client->request('GET', '/api/category');
        $this->assertResponseStatusCodeSame(200);
    }

    public function testGetCategoryAction()
    {
        $client = static::createClient();
        $client->request('GET', '/api/category/10');
        $response = $client->getResponse();
        $this->assertResponseStatusCodeSame(200);
        $response_data = json_decode($response->getContent(), true);
        $this->assertSame(10, $response_data['id']);
        $this->assertSame(1, count($response_data['users']));
        $this->assertSame('merritt.marquardt', $response_data['users'][0]['name']);
    }

    public function testPostCategoryAction()
    {
        $content = [
            'name' => 'Травматолог',
        ];

        $client = static::createClient();
        $client->request('POST', '/api/category', $content);
        $response = $client->getResponse();

        $this->assertResponseStatusCodeSame(201);
        $data = json_decode($response->getContent(), true);
        $data = json_decode($data, true);

        $this->assertEquals('Травматолог', $data['name']);
    }

    public function testDeleteCategoryAction()
    {
        $client = static::createClient();

        $client->request('DELETE', '/api/category/1111111');
        $this->assertResponseStatusCodeSame(404);

        $client->request('DELETE', '/api/category/10');
        $this->assertResponseStatusCodeSame(200);
    }
}