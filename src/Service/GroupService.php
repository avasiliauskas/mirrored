<?php

namespace App\Service;

use App\Entity\Group;
use App\Repository\GroupRepository;
use App\Repository\UserRepository;

final class GroupService
{
    private GroupRepository $groupRepository;
    private UserRepository $userRepository;

    public function __construct(GroupRepository $groupRepository, UserRepository $userRepository)
    {
        $this->groupRepository = $groupRepository;
        $this->userRepository = $userRepository;
    }

    public function all()
    {
        return $this->groupRepository->findAll();
    }

    public function create(string $name)
    {
        $group = new Group();
        $group->setName($name);
        $this->groupRepository->commit($group);
    }

    public function delete(int $id)
    {
        $group = $this->groupRepository->find($id);

        if ($group->getUsers()->count()) {
            return;
        }

        $this->groupRepository->delete($group);
    }

    public function assignUser(string $userName, string $groupName)
    {
        $group = $this->groupRepository->findOneBy(['name' => $groupName]);
        $user = $this->userRepository->findOneBy(['name' => $userName]);

        $group->assignUser($user);
        $this->groupRepository->commit($group);
    }

    public function removeUser(string $userName, string $groupName)
    {
        $group = $this->groupRepository->findOneBy(['name' => $groupName]);
        $user = $this->userRepository->findOneBy(['name' => $userName]);

        $group->removeUser($user);
        $this->groupRepository->commit($group);
    }
}