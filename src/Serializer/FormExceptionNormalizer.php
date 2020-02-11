<?php

namespace App\Serializer;

use App\Exception\FormException;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class FormExceptionNormalizer implements NormalizerInterface
{
    public function normalize($exception, string $format = null, array $context = [])
    {
        $data = [];
        $errors = $exception->getErrors();

        foreach ($errors as $error) {
            $data[$error->getOrigin()->getName()][] = $error->getMessage();
        }

        return $data;
    }

    public function supportsNormalization($data, string $format = null)
    {
        return $data instanceof FormException;
    }
}