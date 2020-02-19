<?php declare(strict_types=1);

namespace App\Constraint;

use Symfony\Component\Validator\Constraints as Assert;

class UserGroupConstraints implements ConstraintContract
{
    /**
     * @Assert\NotBlank(message="group name is missing")
     */
    public string $groupName;

    /**
     * @Assert\NotBlank(message="user name is missing")
     */
    public string $userName;

    public function __construct($groupName, $userName)
    {
        $this->groupName = $groupName;
        $this->userName = $userName;
    }
}