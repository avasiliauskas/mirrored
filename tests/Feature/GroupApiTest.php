<?php namespace App\Tests\Feature;

use App\Entity\Group;
use App\Tests\ApiTestCase;

class GroupApiTest extends ApiTestCase
{
    public function testGetGroups()
    {
        $this->createTestGroup('test_group_1');
        $this->createTestGroup('test_group_2');
        $this->createTestGroup('test_group_3');

        $this->client->request('GET', '/api/v1/group');
        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());
        $this->assertCount(3, json_decode($this->client->getResponse()->getContent())->data);
    }

    public function testCreateGroup()
    {
        $this->client->request('POST', '/api/v1/group', ['name' => 'group_name']);
        $this->assertEquals(201, $this->client->getResponse()->getStatusCode());

        $group = $this->getEntityManager()
            ->getRepository(Group::class)
            ->findByName('group_name');

        $this->assertNotNull($group);
    }

    public function testDeleteGroup()
    {
        $group = $this->createTestGroup('test_group');

        $this->client->request('DELETE', '/api/v1/group/' . $group->getId());
        $this->assertEquals(204, $this->client->getResponse()->getStatusCode());

        $group = $this->getEntityManager()
            ->getRepository(Group::class)
            ->find($group->getId());

        $this->assertNull($group);
    }

    public function testDeleteGroupWithUsers()
    {
        $group = $this->createTestGroup('test_group');
        $user = $this->createTestUser('user', 'password');

        $group->assignUser($user);
        $this->getEntityManager()
            ->getRepository(Group::class)
            ->commit($group);

        $this->client->request('DELETE', '/api/v1/group/' . $group->getId());
        $this->assertEquals(422, $this->client->getResponse()->getStatusCode());

        $group = $this->getEntityManager()
            ->getRepository(Group::class)
            ->find($group->getId());

        $this->assertNotNull($group);
    }

    public function testAssignUserToGroup()
    {
        $group = $this->createTestGroup('test_group');
        $user = $this->createTestUser('user', 'password');
        $user2 = $this->createTestUser('user2', 'password');

        $this->client->request('POST', '/api/v1/group/' . $group->getId() . '/assign',
            [
                'userName' => $user->getName()
            ]
        );
        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());

        $userList = $this->getEntityManager()
            ->getRepository(Group::class)
            ->findOneByName('test_group')
            ->getUsers()
            ->toArray();

        $this->assertCount(1, $userList);

        $this->client->request('POST', '/api/v1/group/' . $group->getId() . '/assign',
            [
                'userName' => $user2->getName()
            ]
        );
        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());

        $userList2 = $this->getEntityManager()
            ->getRepository(Group::class)
            ->findOneByName('test_group')
            ->getUsers()
            ->toArray();

        $this->assertCount(2, $userList2);
    }

    public function testRemoveUserFromGroup()
    {
        $group = $this->createTestGroup('test_group');
        $user = $this->createTestUser('user', 'password');
        $user2 = $this->createTestUser('user2', 'password');

        $group->assignUser($user);
        $group->assignUser($user2);

        $this->getEntityManager()
            ->getRepository(Group::class)
            ->commit($group);

        $this->client->request('DELETE', '/api/v1/group/' . $group->getId() . '/remove',
            [
                'userName' => $user->getName(),
            ]
        );
        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());

        $userList = $this->getEntityManager()
            ->getRepository(Group::class)
            ->findOneByName('test_group')
            ->getUsers()
            ->toArray();

        $this->assertCount(1, $userList);

        $this->client->request('DELETE', '/api/v1/group/' . $group->getId() . '/remove',
            [
                'userName' => $user2->getName()
            ]
        );
        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());

        $userList = $this->getEntityManager()
            ->getRepository(Group::class)
            ->findOneByName('test_group')
            ->getUsers()
            ->toArray();

        $this->assertCount(0, $userList);
    }
}