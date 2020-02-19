<?php declare(strict_types=1);

namespace App\Action;

use App\Entity\User;
use App\Repository\UserRepository;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class CreateUser
{
    private UserRepository $repository;
    private UserPasswordEncoderInterface $passwordEncoder;

    public function __construct(UserRepository $repository, UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->repository = $repository;
        $this->passwordEncoder = $passwordEncoder;
    }

    public function execute(string $name, string $password): void
    {
        $user = new User();
        $user->setName($name);
        $user->setPassword($this->passwordEncoder->encodePassword(
            $user,
            $password
        ));

        $this->repository->commit($user);
    }

}