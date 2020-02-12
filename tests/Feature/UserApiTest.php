<?php namespace App\Tests\Feature;

use App\Entity\User;
use App\Tests\ApiTestCase;

class UserApiTest extends ApiTestCase
{
    public function testGetUsers()
    {
        $this->createTestUser('user', 'password');
        $this->createTestUser('user2', 'password');
        $this->createTestUser('user3', 'password');

        $this->client->request('GET', '/api/v1/user');
        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());
        $this->assertCount(4, json_decode($this->client->getResponse()->getContent()));
    }

    public function testAddUser()
    {
        $data = [
            'name' => 'user',
            'password' => 'password'
        ];

        $this->client->request('POST', '/api/v1/user', $data);
        $this->assertEquals(201, $this->client->getResponse()->getStatusCode());

        $user = $this->getEntityManager()
            ->getRepository(User::class)
            ->findByName($data['name']);

        $this->assertNotNull($user);
    }
}