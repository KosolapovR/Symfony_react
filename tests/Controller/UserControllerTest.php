<?php


namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class UserControllerTest extends WebTestCase
{
    protected function createAuthenticatedClient($email = 'user', $password = 'password')
    {
        $client = static::createClient();
        $client->request(
            'POST',
            '/api/login',
            array(),
            array(),
            array('CONTENT_TYPE' => 'application/json'),
            '{"security" : {"credentials":{"email":"' . $email . '", "password": "' . $password . '"}}}'
        );

        $data = json_decode($client->getResponse()->getContent(), true);

        if (isset($data['token'])) {
            $client = static::createClient();
            $client->setServerParameter('HTTP_Authorization', sprintf('Bearer %s', $data['token']));
            return $client;
        }
        return null;
    }

    public function testGetAllUsersAction()
    {
        $client = $this->createAuthenticatedClient('kosolapov-r@bk.ru', 'romul1991');
        if (!$client) {
            $client = static::createClient();
        }
        $client->request('GET',
            '/api/users');
        $response = $client->getResponse();
        $this->assertResponseStatusCodeSame(200);
        $data = json_decode($response->getContent(), true);
        $response_data = json_decode($data, true);
        $this->assertSame('kosolapov', $response_data[10]['name']
        );
    }

    public function testGetUserAction()
    {
        $client = static::createClient();
        $client->request('GET', '/api/users/6');
        $response = $client->getResponse();
        $this->assertResponseStatusCodeSame(200);
        $data = json_decode($response->getContent(), true);
        $response_data = json_decode($data, true);
        $this->assertSame(6, $response_data['id']);
    }

    public function testPostUserAction()
    {
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

    public function testDeleteUserAction()
    {
        $client = static::createClient();

        $client->request('DELETE', '/api/users/11111');
        $this->assertResponseStatusCodeSame(404);

        $client->request('DELETE', '/api/users/10');
        $this->assertResponseStatusCodeSame(200);
    }

    public function testRequireAuth()
    {
        $client = static::createClient();

        $client->request('GET', '/api/users/4');
        $this->assertResponseStatusCodeSame(401);

        $client->request('DELETE', '/api/users/4');
        $this->assertResponseStatusCodeSame(401);
    }
}