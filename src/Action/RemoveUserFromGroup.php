<?php declare(strict_types=1);

namespace App\Action;

use App\Repository\GroupRepository;
use App\Repository\UserRepository;

class RemoveUserFromGroup
{
    private GroupRepository $groupRepository;
    private UserRepository $userRepository;

    public function __construct(GroupRepository $groupRepository, UserRepository $userRepository)
    {
        $this->groupRepository = $groupRepository;
        $this->userRepository = $userRepository;
    }

    public function execute(string $userName, string $groupName): void
    {
        $group = $this->groupRepository->findOneBy(['name' => $groupName]);
        $user = $this->userRepository->findOneBy(['name' => $userName]);

        $group->removeUser($user);
        $this->groupRepository->commit($group);
    }
}