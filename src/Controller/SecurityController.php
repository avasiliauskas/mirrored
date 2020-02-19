<?php declare(strict_types=1);

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class SecurityController extends AbstractController
{
    public function login()
    {
        return $this->json($this->getUser() ? 'You are logged in!' : 'You are not logged in...');
    }
}