<?php declare(strict_types=1);

namespace App\Constraint;

use Symfony\Component\Validator\Constraints as Assert;
use App\Validator\Constraint\UniqueValueInEntity;
use App\Entity\Group;

class AddGroupConstraints implements ConstraintContract
{
    public static function getConstraints(): Assert\Collection
    {
        return new Assert\Collection([
                'name' => [
                    new Assert\NotBlank(['message' => 'Name is missing']),
                    new UniqueValueInEntity([
                        'field' => 'name',
                        'entityClass' => Group::class,
                    ])
                ]
            ]
        );
    }
}