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

    public function getGroups()
    {
        return $this->json($this->service->all());
    }

    public function create(Request $request)
    {
        $this->service->create($request->get('name'));
        return $this->json('created');
    }

    public function delete(Request $request)
    {
        $this->service->delete($request->get('id'));
        return $this->json('deleted');
    }

    public function assignUser(Request $request)
    {
        $this->service->assignUser($request->get('userName'), $request->get('groupName'));
        return $this->json('success');
    }

    public function removeUser(Request $request)
    {
        $this->service->removeUser($request->get('userName'), $request->get('groupName'));
        return $this->json('success');
    }
}