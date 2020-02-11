<?php

namespace App\Tests;

use App\Entity\Group;
use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ApiTestCase extends WebTestCase
{
    protected KernelBrowser $client;

    protected function setUp()
    {
        $this->client = self::createClient();
        $this->createUserAndLogIn($this->client);
    }

    protected function createUserAndLogin(KernelBrowser $client)
    {
        $this->createTestUser('admin', 'password', User::ROLE_ADMIN);

        $client->request(
            'POST',
            '/login',
            [],
            [],
            ['CONTENT_TYPE' => 'application/json'],
            '{"name":"admin", "password":"password"}'
        );

        $this->assertResponseStatusCodeSame(200);
    }

    protected function createTestUser(string $name, string $password, string $role = User::ROLE_USER): User
    {
        $user = new User();
        $user->setName($name);
        $user->setPassword($this->getService('security.password_encoder')->encodePassword($user, $password));
        $user->setRoles([$role]);

        $this->getEntityManager()
            ->getRepository(User::class)
            ->commit($user);

        return $user;
    }

    protected function createTestGroup(string $name): Group
    {
        $group = new Group();
        $group->setName($name);

        $this->getEntityManager()
            ->getRepository(Group::class)
            ->commit($group);

        return $group;
    }

    protected function getService($id)
    {
        return self::$kernel->getContainer()->get($id);
    }

    protected function getEntityManager()
    {
        return $this->getService('doctrine.orm.entity_manager');
    }
}