<?php declare(strict_types=1);

namespace App\Controller\Api;

use App\Action\CreateUser;
use App\Action\GetUsers;
use App\Constraint\AddUserConstraints;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class UserController extends BaseController
{
    public function create(Request $request, CreateUser $action): JsonResponse
    {
        $this->validateRequest($request->request->all(), AddUserConstraints::getConstraints());

        $action->execute($request->get('name'), $request->get('password'));
        return $this->json('User created!', 201);
    }

    public function all(GetUsers $action): JsonResponse
    {
        return $this->json($action->execute());
    }

}