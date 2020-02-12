<?php

namespace App\Serializer;

use App\Exception\ApiException;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class ApiExceptionNormalizer implements NormalizerInterface
{
    public function normalize($exception, string $format = null, array $context = [])
    {
        return (array) $exception->getErrors();


    }

    public function supportsNormalization($data, string $format = null)
    {
        return $data instanceof ApiException;
    }
}