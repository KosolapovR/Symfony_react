<?php


namespace App\Tests\Controller;


use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\SerializerInterface;

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

        $client->request('DELETE', '/api/users/1');
        $this->assertResponseStatusCodeSame(404);

        $client->request('DELETE', '/api/users/14');
        $this->assertResponseStatusCodeSame(200);
    }
}