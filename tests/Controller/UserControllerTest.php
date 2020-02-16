<?php


namespace App\Tests\Controller;


use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class UserControllerTest extends WebTestCase
{
    public function testGetAllUsersAction(){
        $clinet = static::createClient();
        $clinet->request('GET', '/api/users');
        $this->assertResponseStatusCodeSame(200);
    }

    public function testGetUserAction(){
        $clinet = static::createClient();
        $clinet->request('GET', '/api/users/6');
        $response = $clinet->getResponse();
        $this->assertResponseStatusCodeSame(200);
        $response_data = json_decode($response->getContent(), true);
        $this->assertSame(1, $this->count($response_data));
    }

    public function testPostUserAction(){
        $client = static::createClient();
        $client->request('POST', '/api/users', [
            'name' => 'Имя',
            'email' => 'email@mail.ru',
            'password' => 125,
            'role' => 'ROLE_USER',
            'day_of_birth' => '1991-06-04',
            'category' => 16
        ]);
        $response = $client->getResponse();
        $this->assertResponseStatusCodeSame(201);
        $data = json_decode($response->getContent());
        //$password = $data['password'];
        $this->assertSame('125', $response->getContent());
    }
}