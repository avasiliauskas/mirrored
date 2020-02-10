<?php namespace App\Tests\Feature;

use App\Entity\User;
use App\Tests\ApiTestCase;

class UserApiTest extends ApiTestCase
{
    public function testGetUsers()
    {
        $this->setAdminClient();

        $this->createTestUser('user', 'password', User::ROLE_USER);

        self::$client->request('GET', '/api/v1/user', [], [],
            [
                'PHP_AUTH_USER' => 'admin',
                'PHP_AUTH_PW' => 'password',
            ]
        );
        $this->assertEquals(200, self::$client->getResponse()->getStatusCode());

        $this->assertCount(1, json_decode(self::$client->getResponse()->getContent()));
    }

    public function testAddUser()
    {
        $this->setAdminClient();

        $data = [
            'name' => 'user',
            'password' => 'password'
        ];

        self::$client->request('POST', '/api/v1/user', $data);
        $this->assertEquals(200, self::$client->getResponse()->getStatusCode());

        $user = self::$client->getContainer()
            ->get('doctrine.orm.entity_manager')
            ->getRepository(User::class)
            ->findByName($data['name']);

        $this->assertNotNull($user);
    }

//    public function testGetUsersUnauthorized()
//    {
//        $this->setGuestClient();
//        self::$client->request('GET', '/api/v1/user');
//        $this->assertEquals(401, self::$client->getResponse()->getStatusCode());
//    }
//
//    public function testAddUsersUnauthorized()
//    {
//        $this->setGuestClient();
//        self::$client->request('POST', '/api/v1/user');
//        $this->assertEquals(401, self::$client->getResponse()->getStatusCode());
//    }
}