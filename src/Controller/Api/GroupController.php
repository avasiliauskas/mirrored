<?php

namespace App\Controller\Api;

use App\Constraint\DeleteGroupConstraints;
use App\Service\GroupService;
use App\Constraint\AddGroupConstraints;
use App\Constraint\UserGroupConstraints;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class GroupController extends BaseController
{
    private GroupService $service;

    public function __construct(GroupService $service, ValidatorInterface $validator)
    {
        $this->service = $service;
        $this->validator = $validator;
    }

    public function all()
    {
        return $this->json($this->service->all());
    }

    public function create(Request $request)
    {
        $this->validateRequest(new AddGroupConstraints($request->get('name')));

        $this->service->create($request->get('name'));
        return $this->json('created', 201);
    }

    public function delete(Request $request)
    {
        $this->validateRequest(new DeleteGroupConstraints($request->get('name')));

        $this->service->delete($request->get('name'));
        return $this->json('deleted!', 204);
    }

    public function assignUser(Request $request)
    {
        $this->validateRequest(new UserGroupConstraints($request->get('groupName'), $request->get('userName')));

        $this->service->assignUser($request->get('userName'), $request->get('groupName'));
        return $this->json('success');
    }

    public function removeUser(Request $request)
    {
        $this->validateRequest(new UserGroupConstraints($request->get('groupName'), $request->get('userName')));

        $this->service->removeUser($request->get('userName'), $request->get('groupName'));
        return $this->json('success');
    }
}