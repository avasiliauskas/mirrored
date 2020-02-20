<?php namespace App\Tests\Feature;

use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class UnauthorizedTest extends WebTestCase
{
    private KernelBrowser $client;

    protected function setUp()
    {
        $this->client = self::createClient();
    }

    public function testGetUsersUnauthorized()
    {
        $this->client->request('GET', '/api/v1/user');
        $this->assertEquals(401, $this->client->getResponse()->getStatusCode());
    }

    public function testAddUsersUnauthorized()
    {
        $this->client->request('POST', '/api/v1/user');
        $this->assertEquals(401, $this->client->getResponse()->getStatusCode());
    }

    public function testCreateGroupUnauthorized()
    {
        $this->client->request('POST', '/api/v1/group');
        $this->assertEquals(401, $this->client->getResponse()->getStatusCode());
    }

    public function testDeleteGroupUnauthorized()
    {
        $this->client->request('DELETE', '/api/v1/group/1');
        $this->assertEquals(401, $this->client->getResponse()->getStatusCode());
    }

    public function testGetGroupsUnauthorized()
    {
        $this->client->request('GET', '/api/v1/group');
        $this->assertEquals(401, $this->client->getResponse()->getStatusCode());
    }

    public function testAssignUserToGroupUnauthorized()
    {
        $this->client->request('POST', '/api/v1/group/1/assign');
        $this->assertEquals(401, $this->client->getResponse()->getStatusCode());
    }

    public function testRemoveUserFromGroupUnauthorized()
    {
        $this->client->request('DELETE', '/api/v1/group/1/remove');
        $this->assertEquals(401, $this->client->getResponse()->getStatusCode());
    }
}