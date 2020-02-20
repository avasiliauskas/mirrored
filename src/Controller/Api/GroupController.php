<?php declare(strict_types=1);

namespace App\Controller\Api;

use App\Action\AssignUserToGroup;
use App\Action\CreateGroup;
use App\Action\DeleteGroup;
use App\Action\GetGroups;
use App\Action\RemoveUserFromGroup;
use App\Constraint\DeleteGroupConstraints;
use App\Constraint\AddGroupConstraints;
use App\Constraint\UserGroupConstraints;
use App\Http\ApiResponse;
use Symfony\Component\HttpFoundation\Request;

class GroupController extends BaseController
{
    public function all(GetGroups $action): ApiResponse
    {
        return ApiResponse::create($action->execute());

    }

    public function create(Request $request, CreateGroup $action): ApiResponse
    {
        $this->validateRequest($request->request->all(), AddGroupConstraints::getConstraints());

        $action->execute($request->get('name'));
        return ApiResponse::create([], 201);
    }

    public function delete(int $id, DeleteGroup $action): ApiResponse
    {
        $action->execute($id);
        return ApiResponse::create([], 204);
    }

    public function assignUser(int $groupId, Request $request, AssignUserToGroup $action): ApiResponse
    {
        $this->validateRequest($request->request->all(), UserGroupConstraints::getConstraints());

        $action->execute($request->get('userName'), $groupId);
        return ApiResponse::create();
    }

    public function removeUser(int $groupId, Request $request, RemoveUserFromGroup $action): ApiResponse
    {
        $this->validateRequest($request->request->all(), UserGroupConstraints::getConstraints());

        $action->execute($request->get('userName'), $groupId);
        return ApiResponse::create();
    }
}