<?php declare(strict_types=1);

namespace App\Service;

use App\Entity\User;
use App\Repository\UserRepository;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

final class UserService
{
    private UserRepository $repository;
    private UserPasswordEncoderInterface $passwordEncoder;

    public function __construct(UserRepository $repository, UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->repository = $repository;
        $this->passwordEncoder = $passwordEncoder;
    }

    public function all(): iterable
    {
        return $this->repository->findAll();
    }

    public function create(string $name, string $password): void
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