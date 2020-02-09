<?php

namespace App\Controller;

use App\Service\GroupService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class GroupController extends AbstractController
{
    private GroupService $service;

    public function __construct(GroupService $service)
    {
        $this->service = $service;
    }

    public function createGroup(Request $request)
    {
        $this->service->create($request->get('name'));
        return $this->json('created');
    }

    public function deleteGroup(int $id)
    {
        $this->service->delete($id);
        return $this->json('deleted');
    }

    public function assignUserToGroup(int $userId)
    {
        $this->service->assignUser($userId);
        return $this->json('success');
    }

    public function removeUserFromGroup(int $userId)
    {
        $this->service->removeUser($userId);
        return $this->json('success');
    }

    public function getGroups()
    {
        return $this->json($this->service->all());
    }
}