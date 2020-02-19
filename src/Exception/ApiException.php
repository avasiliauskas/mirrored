<?php declare(strict_types=1);

namespace App\Exception;

use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\Validator\ConstraintViolationListInterface;

class ApiException extends HttpException
{
    private ?ConstraintViolationListInterface $violations;
    const VALIDATION_ERROR_TYPE = 'validation_error';
    const UNIQUE_VALIDATION_ERROR_MESSAGE = 'Unique constrain violation';

    public function __construct(
        ?ConstraintViolationListInterface $violations,
        int $statusCode = 400,
        string $message = null,
        \Exception $previous = null,
        array $headers = [],
        ?int $code = 0
    ) {
        parent::__construct($statusCode, $message, $previous, $headers, $code);

        $this->violations = $violations;
    }

    public function getErrors(): array
    {
        $errors = [];

        foreach ($this->violations as $violation) {
            $errors[$violation->getPropertyPath()][] = $violation->getMessage();
        }

        return $errors;
    }
}