<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class SecurityController extends AbstractController
{
    public function login()
    {
        return $this->json([
                'user' => $this->getUser() ? $this->getUser()->getId() : null
            ]
        );
    }
}