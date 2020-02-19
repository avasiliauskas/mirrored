<?php declare(strict_types=1);

namespace App\Constraint;

use Symfony\Component\Validator\Constraints as Assert;

class DeleteGroupConstraints implements ConstraintContract
{
    /**
     * @Assert\NotBlank(message="Name is missing")
     */
    public string $name;

    public function __construct($name)
    {
        $this->name = $name;
    }
}