<?php

namespace App\Controller\Api;

use App\Constraint\ConstraintContract;
use App\Exception\ApiException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Validator\Validator\ValidatorInterface;

abstract class BaseController extends AbstractController
{
    protected ValidatorInterface $validator;

    protected function validateRequest(ConstraintContract $constraints): void
    {
        $violations = $this->validator->validate($constraints);

        if ($violations->count()) {
            throw new ApiException($violations, 422, ApiException::VALIDATION_ERROR_TYPE);
        }
    }
}