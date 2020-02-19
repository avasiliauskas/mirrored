<?php declare(strict_types=1);

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;

class IndexController
{
    public function index()
    {
        return new Response('User API');
    }
}