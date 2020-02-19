<?php declare(strict_types=1);

namespace App\Controller\Api;

use App\Action\CreateGroup;
use App\Action\DeleteGroup;
use App\Action\GetGroups;
use App\Action\RemoveUserFromGroup;
use App\Constraint\DeleteGroupConstraints;
use App\Constraint\AddGroupConstraints;
use App\Constraint\UserGroupConstraints;
use App\Service\AssignUserToGroup;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class GroupController extends BaseController
{
    public function all(GetGroups $action): JsonResponse
    {
        return $this->json($action->execute());
    }

    public function create(Request $request, CreateGroup $action): JsonResponse
    {
        $this->validateRequest($request->request->all(), AddGroupConstraints::getConstraints());

        $action->execute($request->get('name'));
        return $this->json('created', 201);
    }

    public function delete(Request $request, DeleteGroup $action): JsonResponse
    {
        $this->validateRequest($request->request->all(), DeleteGroupConstraints::getConstraints());

        $action->execute($request->get('name'));
        return $this->json('deleted!', 204);
    }

    public function assignUser(Request $request, AssignUserToGroup $action): JsonResponse
    {
        $this->validateRequest($request->request->all(), UserGroupConstraints::getConstraints());

        $action->execute($request->get('userName'), $request->get('groupName'));
        return $this->json('success');
    }

    public function removeUser(Request $request, RemoveUserFromGroup $action): JsonResponse
    {
        $this->validateRequest($request->request->all(), UserGroupConstraints::getConstraints());

        $action->execute($request->get('userName'), $request->get('groupName'));
        return $this->json('success');
    }
}