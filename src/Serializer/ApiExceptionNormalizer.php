<?php declare(strict_types=1);

namespace App\Serializer;

use App\Exception\ApiException;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class ApiExceptionNormalizer implements NormalizerInterface
{
    public function normalize($exception, string $format = null, array $context = []): array
    {
        return (array) $exception->getErrors();
    }

    public function supportsNormalization($data, string $format = null): bool
    {
        return $data instanceof ApiException;
    }
}