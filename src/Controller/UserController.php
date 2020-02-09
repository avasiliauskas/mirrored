<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;

class UserController
{
    public function addUser()
    {
        return new Response('adding user...');
    }
}