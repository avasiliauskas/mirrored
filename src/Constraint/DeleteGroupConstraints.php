<?php

namespace App\Constraint;

use Symfony\Component\Validator\Constraints as Assert;

class DeleteGroupConstraints implements ConstraintContract
{
    /**
     * @Assert\NotBlank(message="Name is missing")
     */
    public $name;

    public function __construct($name)
    {
        $this->name = $name;
    }
}