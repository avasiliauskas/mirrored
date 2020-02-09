<?php namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class PostControllerTest extends WebTestCase
{
    public function testAddUser()
    {
        $client = static::createClient();

        $client->request('GET', 'api/v1/user');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }
}