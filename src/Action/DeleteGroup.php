<?php declare(strict_types=1);

namespace App\Action;

use App\Exception\ApiException;
use App\Repository\GroupRepository;

class DeleteGroup
{
    private GroupRepository $groupRepository;

    public function __construct(GroupRepository $groupRepository)
    {
        $this->groupRepository = $groupRepository;
    }

    public function execute(string $name): void
    {
        $group = $this->groupRepository->findOneBy(['name' => $name]);

        if ($group && $group->getUsers()->count()) {
            throw new ApiException(null, 422, ApiException::UNIQUE_VALIDATION_ERROR_MESSAGE);
        }

        $this->groupRepository->delete($group);
    }
}