<?php declare(strict_types=1);

namespace App\Controller\Api;

use App\Exception\ApiException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Validator\Constraints\Collection;
use Symfony\Component\Validator\Validator\ValidatorInterface;

abstract class BaseController extends AbstractController
{
    protected ValidatorInterface $validator;

    public function __construct(ValidatorInterface $validator)
    {
        $this->validator = $validator;
    }

    protected function validateRequest(array $values, Collection $constraints): void
    {
        $violations = $this->validator->validate($values, $constraints);

        if ($violations->count()) {
            throw new ApiException($violations, 422, ApiException::VALIDATION_ERROR_TYPE);
        }
    }
}