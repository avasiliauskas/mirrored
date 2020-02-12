<?php

namespace App\Validator\Constraint;

use App\Validator\UniqueValueInEntityValidator;
use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class UniqueValueInEntity extends Constraint
{
    public $message = 'This value is already in use';
    public $entityClass;
    public $field;

    public function getRequiredOptions()
    {
        return ['entityClass', 'field'];
    }

    public function getTargets()
    {
        return self::PROPERTY_CONSTRAINT;
    }

    public function validatedBy()
    {
        return UniqueValueInEntityValidator::class;
    }
}