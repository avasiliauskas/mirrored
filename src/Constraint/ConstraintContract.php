<?php declare(strict_types=1);

namespace App\Constraint;

use Symfony\Component\Validator\Constraints\Collection;

interface ConstraintContract
{
    public static function getConstraints(): Collection;
}