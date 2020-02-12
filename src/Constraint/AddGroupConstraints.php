<?php

namespace App\Constraint;

use Symfony\Component\Validator\Constraints as Assert;
use App\Validator\Constraint\UniqueValueInEntity as UniqueAssert;
use App\Entity\Group;

class AddGroupConstraints implements ConstraintContract
{
    /**
     * @Assert\NotBlank(message="Name is missing")
     * @UniqueAssert(entityClass=Group::class, field="name")
     */
    public $name;

    public function __construct($name)
    {
        $this->name = $name;
    }
}