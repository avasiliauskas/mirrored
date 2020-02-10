<?php namespace App\Tests\Feature;

use App\Entity\Group;
use App\Tests\ApiTestCase;

class GroupApiTest extends ApiTestCase
{
//    public function testCreateGroup()
//    {
//        self::$client->request('POST', '/api/v1/group', ['name' => 'group_name']);
//        $this->assertEquals(200, self::$client->getResponse()->getStatusCode());
//
//        $group = self::$client->getContainer()
//            ->get('doctrine.orm.entity_manager')
//            ->getRepository(Group::class)
//            ->findByName('group_name');
//
//        $this->assertNotNull($group);
//    }
//
//    public function testDeleteGroup()
//    {
//        $group = self::createTestGroup('test_group');
//
//        self::$client->request('DELETE', '/api/v1/group', ['id' => $group->getId()]);
//        $this->assertEquals(200, self::$client->getResponse()->getStatusCode());
//
//        $group = self::$client->getContainer()
//            ->get('doctrine.orm.entity_manager')
//            ->getRepository(Group::class)
//            ->find($group->getId());
//
////        $this->assertNull($group); TODO
//    }
//
//    public function testGetGroups()
//    {
//        self::createTestGroup('test_group_1');
//
//        self::$client->request('GET', '/api/v1/group');
//        $this->assertEquals(200, self::$client->getResponse()->getStatusCode());
//
//        $this->assertCount(1, json_decode(self::$client->getResponse()->getContent()));
//    }
//
//    public function testAssignUserToGroup()
//    {
//        // TODO
//    }
//
//    public function testRemoveUserFromGroup()
//    {
//        // TODO
//    }
//
//    public function testCreateGroupUnauthorized()
//    {
//        self::$client->request('POST', '/api/v1/group');
//        $this->assertEquals(401, self::$client->getResponse()->getStatusCode());
//    }
//
//    public function testDeleteGroupUnauthorized()
//    {
//        self::$client->request('DELETE', '/api/v1/group');
//        $this->assertEquals(401, self::$client->getResponse()->getStatusCode());
//    }
//
//    public function testGetGroupsUnauthorized()
//    {
//        self::$client->request('GET', '/api/v1/group');
//        $this->assertEquals(401, self::$client->getResponse()->getStatusCode());
//    }
//
//    public function testAssignUserToGroupUnauthorized()
//    {
//        self::$client->request('POST', '/api/v1/group/assign');
//        $this->assertEquals(401, self::$client->getResponse()->getStatusCode());
//    }
//
//    public function testRemoveUserFromGroupUnauthorized()
//    {
//        self::$client->request('POST', '/api/v1/group/remove');
//        $this->assertEquals(401, self::$client->getResponse()->getStatusCode());
//    }
}