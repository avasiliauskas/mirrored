<?php declare(strict_types=1);

namespace App\Controller\Api;

use App\Constraint\DeleteGroupConstraints;
use App\Service\GroupService;
use App\Constraint\AddGroupConstraints;
use App\Constraint\UserGroupConstraints;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class GroupController extends BaseController
{
    private GroupService $service;

    public function __construct(GroupService $service, ValidatorInterface $validator)
    {
        parent::__construct($validator);
        $this->service = $service;
    }

    public function all(): JsonResponse
    {
        return $this->json($this->service->all());
    }

    public function create(Request $request): JsonResponse
    {
        $this->validateRequest($request->request->all(), AddGroupConstraints::getConstraints());

        $this->service->create($request->get('name'));
        return $this->json('created', 201);
    }

    public function delete(Request $request): JsonResponse
    {
        $this->validateRequest($request->request->all(), DeleteGroupConstraints::getConstraints());

        $this->service->delete($request->get('name'));
        return $this->json('deleted!', 204);
    }

    public function assignUser(Request $request): JsonResponse
    {
        $this->validateRequest($request->request->all(), UserGroupConstraints::getConstraints());

        $this->service->assignUser($request->get('userName'), $request->get('groupName'));
        return $this->json('success');
    }

    public function removeUser(Request $request): JsonResponse
    {
        $this->validateRequest($request->request->all(), UserGroupConstraints::getConstraints());

        $this->service->removeUser($request->get('userName'), $request->get('groupName'));
        return $this->json('success');
    }
}