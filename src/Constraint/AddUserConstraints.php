<?php

namespace App\Constraint;

use Symfony\Component\Validator\Constraints as Assert;
use App\Validator\Constraint\UniqueValueInEntity as UniqueAssert;
use App\Entity\User;

class AddUserConstraints implements ConstraintContract
{
    /**
     * @UniqueAssert(entityClass=User::class, field="name")
     * @Assert\NotBlank(message="Password is missing")
     */
    public $name;

    /**
     * @Assert\NotBlank(message="Password is missing")
     */
    public $password;

    public function __construct($name, $password)
    {
        $this->name = $name;
        $this->password = $password;
    }
}