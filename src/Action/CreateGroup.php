<?php declare(strict_types=1);

namespace App\Action;

use App\Entity\Group;
use App\Repository\GroupRepository;

class CreateGroup
{
    private GroupRepository $groupRepository;

    public function __construct(GroupRepository $groupRepository)
    {
        $this->groupRepository = $groupRepository;
    }

    public function execute(string $name): void
    {
        $group = new Group();
        $group->setName($name);
        $this->groupRepository->commit($group);
    }
}