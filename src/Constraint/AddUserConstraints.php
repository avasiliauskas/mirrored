<?php declare(strict_types=1);

namespace App\Constraint;

use App\Validator\Constraint\UniqueValueInEntity;
use Symfony\Component\Validator\Constraints as Assert;
use App\Entity\User;

class AddUserConstraints implements ConstraintContract
{
    public static function getConstraints(): Assert\Collection
    {
        return new Assert\Collection([
                'name' => [
                    new Assert\NotBlank(['message' => 'Name is missing']),
                    new UniqueValueInEntity([
                        'field' => 'name',
                        'entityClass' => User::class,
                    ])
                ],
                'password' => [
                    new Assert\NotBlank(['message' => 'Password is missing'])
                ]
            ]
        );
    }
}