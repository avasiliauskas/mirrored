<?php

namespace App\Controller;

use App\Entity\User;
use App\Exception\FormException;
use App\Form\UserType;
use App\Service\UserService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

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

    public function getUsers(Request $request)
    {
        $user = new User();

        $form = $this->createForm(UserType::class, $user);
//                $this->processForm($request, $form);


        $form->submit(json_decode($request->getContent(), true));

        // TODO turn off csrf protection
        if ($form->isSubmitted() && !$form->isValid()) {
            throw new FormException($form, 400, 'o ne');
        }

        return $this->json($this->service->all());
    }

//    protected function decodeRequestBody(Request $request)
//    {
//        // allow for a possibly empty body
//        if (!$request->getContent()) {
//            return array();
//        }
//
//        $data = json_decode($request->getContent(), true);
//        if ($data === null) {
//            $apiProblem = new ApiProblem(400, ApiProblem::TYPE_INVALID_REQUEST_BODY_FORMAT);
//
//            throw new ApiProblemException($apiProblem);
//        }
//
//        return $data;
//    }
}