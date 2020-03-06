<?php


namespace App\Tests\Controller;


use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class UserControllerTest extends WebTestCase
{
    public function testGetAllUsersAction(){
        $client = static::createClient();
        $client->request('GET', '/api/users');
        $this->assertResponseStatusCodeSame(200);
    }

    public function testGetUserAction(){
        $client = static::createClient();
        $client->request('GET', '/api/users/6');
        $response = $client->getResponse();
        $this->assertResponseStatusCodeSame(200);
        $data = json_decode($response->getContent(), true);
        $response_data = json_decode($data, true);
        $this->assertSame(6, $response_data['id']);
    }

    public function testPostUserAction(){
        $content = [
            'name' => 'Name',
            'email' => 'email@mail.ru',
            'password' => '125',
            'role' => 'ROLE_USER',
            'day_of_birth' => '1991-06-04',
            'category' => 16
        ];

        $client = static::createClient();
        $client->request('POST', '/api/users', $content);
        $response = $client->getResponse();

        $this->assertResponseStatusCodeSame(201);
        $data = json_decode($response->getContent(), true);
        $data = json_decode($data, true);

        $this->assertEquals('125', $data['password']);
    }

    public function testDeleteUserAction(){
        $client = static::createClient();

        $client->request('DELETE', '/api/users/11111');
        $this->assertResponseStatusCodeSame(404);

        $client->request('DELETE', '/api/users/10');
        $this->assertResponseStatusCodeSame(200);
    }
}