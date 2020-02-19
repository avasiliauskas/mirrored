<?php declare(strict_types=1);

namespace App\Constraint;

use Symfony\Component\Validator\Constraints as Assert;

class DeleteGroupConstraints implements ConstraintContract
{
    public static function getConstraints(): Assert\Collection
    {
        return new Assert\Collection([
                'name' => [
                    new Assert\NotBlank(['message' => 'Name is missing'])
                ]
            ]
        );
    }
}