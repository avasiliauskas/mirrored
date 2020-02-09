<?php

namespace App\Service;

use App\Entity\Group;
use App\Repository\GroupRepository;

final class GroupService
{
    private GroupRepository $repository;

    public function __construct(GroupRepository $repository)
    {
        $this->repository = $repository;
    }

    public function all()
    {
        return $this->repository->findAll();
    }

    public function create(string $name)
    {
        $group = new Group();
        $group->setName($name);
        $this->repository->create($group);
    }

    public function delete(int $id)
    {
        $group = $this->repository->find($id);

        $this->repository->delete($group);

        return true;
    }

    public function assignUser(int $userId, int $groupId)
    {
        // TODo
    }

    public function removeUser(int $userId, int $groupId)
    {
        // TODO
    }
}