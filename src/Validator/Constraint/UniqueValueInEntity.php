<?php declare(strict_types=1);

namespace App\Validator\Constraint;

use App\Validator\UniqueValueInEntityValidator;
use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class UniqueValueInEntity extends Constraint
{
    public string $message = 'This value is already in use';
    public string $entityClass;
    public string $field;

    public function getRequiredOptions(): array
    {
        return ['entityClass', 'field'];
    }

    public function getTargets(): string
    {
        return self::PROPERTY_CONSTRAINT;
    }

    public function validatedBy(): string
    {
        return UniqueValueInEntityValidator::class;
    }
}