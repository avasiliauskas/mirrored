<?php declare(strict_types=1);

namespace App\Action;

use App\Repository\GroupRepository;

class GetGroups
{
    private GroupRepository $groupRepository;

    public function __construct(GroupRepository $groupRepository)
    {
        $this->groupRepository = $groupRepository;
    }

    public function execute(): iterable
    {
        return $this->groupRepository->findAll();
    }
}