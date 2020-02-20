<?php declare(strict_types=1);

namespace App\Constraint;

use Symfony\Component\Validator\Constraints as Assert;

class UserGroupConstraints implements ConstraintContract
{
    public static function getConstraints(): Assert\Collection
    {
        return new Assert\Collection([
                'userName' => [
                    new Assert\NotBlank(['message' => 'User mame is missing'])
                ]
            ]
        );
    }
}