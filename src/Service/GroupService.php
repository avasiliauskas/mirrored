<?php declare(strict_types=1);

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

    public function all(): iterable
    {
        return $this->groupRepository->findAll();
    }

    public function create(string $name): void
    {
        $group = new Group();
        $group->setName($name);
        $this->groupRepository->commit($group);
    }

    public function delete(string $name): void
    {
        $group = $this->groupRepository->findOneBy(['name' => $name]);

        if ($group && $group->getUsers()->count()) {
            throw new ApiException(null, 422, ApiException::UNIQUE_VALIDATION_ERROR_MESSAGE);
        }

        $this->groupRepository->delete($group);
    }

    public function assignUser(string $userName, string $groupName): void
    {
        $group = $this->groupRepository->findOneBy(['name' => $groupName]);
        $user = $this->userRepository->findOneBy(['name' => $userName]);

        $group->assignUser($user);
        $this->groupRepository->commit($group);
    }

    public function removeUser(string $userName, string $groupName): void
    {
        $group = $this->groupRepository->findOneBy(['name' => $groupName]);
        $user = $this->userRepository->findOneBy(['name' => $userName]);

        $group->removeUser($user);
        $this->groupRepository->commit($group);
    }
}