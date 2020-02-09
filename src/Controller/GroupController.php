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

    public function create(Request $request)
    {
        $this->service->create($request->get('name'));
        return $this->json('created');
    }

    public function delete(int $id)
    {
        $this->service->delete($id);
        return $this->json('deleted');
    }

    public function assignUser(Request $request)
    {
        $this->service->assignUser($request->get('userId'), $request->get('groupId'));
        return $this->json('success');
    }

    public function removeUser(Request $request)
    {
        $this->service->removeUser($request->get('userId'), $request->get('groupId'));
        return $this->json('success');
    }

    public function getGroups()
    {
        return $this->json($this->service->all());
    }
}