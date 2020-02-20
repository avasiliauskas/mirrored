<?php declare(strict_types=1);

namespace App\Action;

use App\Repository\UserRepository;

final class GetUsers
{
    private UserRepository $repository;

    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    public function execute(): array
    {
        return $this->repository->findAll();
    }
}