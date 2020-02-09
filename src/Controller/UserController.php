<?php

namespace App\Controller;

use App\Service\UserService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class UserController extends AbstractController
{
    private UserService $service;

    public function __construct(UserService $service)
    {
        $this->service = $service;
    }

    public function addUser(Request $request)
    {
        $this->service->create($request->get('name'), $request->get('password'));
        return $this->json('user created');
    }

    public function getUsers()
    {
        return $this->json($this->service->all());
    }
}