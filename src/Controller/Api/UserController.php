<?php declare(strict_types=1);

namespace App\Controller\Api;

use App\Service\UserService;
use App\Constraint\AddUserConstraints;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class UserController extends BaseController
{
    private UserService $service;

    public function __construct(UserService $service, ValidatorInterface $validator)
    {
        parent::__construct($validator);
        $this->service = $service;
    }

    public function create(Request $request): JsonResponse
    {
        $this->validateRequest($request->request->all(), AddUserConstraints::getConstraints());

        $this->service->create($request->get('name'), $request->get('password'));
        return $this->json('User created!', 201);
    }

    public function all(): JsonResponse
    {
        return $this->json($this->service->all());
    }

}