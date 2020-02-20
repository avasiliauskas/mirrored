<?php declare(strict_types=1);

namespace App\Controller\Api;

use App\Action\CreateUser;
use App\Action\GetUsers;
use App\Constraint\AddUserConstraints;
use App\Http\ApiResponse;
use Symfony\Component\HttpFoundation\Request;

class UserController extends BaseController
{
    public function create(Request $request, CreateUser $action): ApiResponse
    {
        $this->validateRequest($request->request->all(), AddUserConstraints::getConstraints());

        $action->execute($request->get('name'), $request->get('password'));
        return ApiResponse::create([], 201);
    }

    public function all(GetUsers $action): ApiResponse
    {
        return ApiResponse::create($action->execute());
    }

}