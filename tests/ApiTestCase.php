<?php

namespace App\Tests;

use App\Entity\Group;
use App\Entity\User;
use GuzzleHttp\Client;
use GuzzleHttp\Cookie\CookieJar;
use GuzzleHttp\RequestOptions;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ApiTestCase extends WebTestCase
{
    protected static KernelBrowser $client;

//    public function setUp(): void
//    {
//        parent::setUp();
//
//        if (null === self::$user) {
//            self::$user = static::createClient();
//            self::$user->insulate();
//
//            self::createTestUser('admin', 'password', User::ROLE_ADMIN);
//        }
//
//        if (null === self::$client) {
//            self::$client = static::createClient([],
//                [
//                    'PHP_AUTH_USER' => 'admin',
//                    'PHP_AUTH_PW' => 'password',
//                ]
//            );
//        }
//    }

    protected function setAdminClient()
    {
        self::$client = static::createClient();
        self::createTestUser('admin', 'password', User::ROLE_ADMIN);


        $client = new Client();

        $response = $client->post('http://user-api.test/login', [
            RequestOptions::JSON => ['name' => 'admin', 'password' => 'password']
        ]);

        dump($response->getHeaders()['Set-Cookie']);

        $jar = CookieJar::fromArray(
            [
                'PHPSESSID' => '5289kln1sicc6te5cnv4htj90j',
            ],
            'user-api.test'
        );

        $response = $client->get('http://user-api.test/api/v1/user', ['cookie' => $jar]);

        dump($response->getStatusCode());

    }

    protected function setGuestClient()
    {
        self::$client = static::createClient();
    }

    protected function createTestUser(string $name, string $password, string $role): User
    {
        $user = new User();
        $user->setName($name);
        $user->setPassword($password);
        $user->setRoles([$role]);

        self::$client->getContainer()
            ->get('doctrine.orm.entity_manager')
            ->getRepository(User::class)
            ->create($user);

        return $user;
    }

    protected function createTestGroup(string $name): Group
    {
        $group = new Group();
        $group->setName($name);

        self::$client->getContainer()
            ->get('doctrine.orm.entity_manager')
            ->getRepository(Group::class)
            ->create($group);

        return $group;
    }

}