<?php

namespace App\Service;

use App\Entity\Group;
use App\Exception\ApiException;
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

    public function delete(string $name)
    {
        $group = $this->groupRepository->findOneBy(['name' => $name]);

        if ($group && $group->getUsers()->count()) {
            throw new ApiException([], 422, 'validation error');
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