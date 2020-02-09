<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;

class SecurityController
{
    public function login()
    {
        return new Response('You are logged in!');
    }
}