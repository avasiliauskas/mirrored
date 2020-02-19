<?php declare(strict_types=1);

namespace App\Factory;

use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class NormalizerFactory
{
    private iterable $normalizers;

    public function __construct(iterable $normalizers)
    {
        $this->normalizers = $normalizers;
    }

    public function getNormalizer(array $data): ?iterable
    {
        foreach ($this->normalizers as $normalizer) {
            if ($normalizer instanceof NormalizerInterface && $normalizer->supportsNormalization($data)) {
                return $normalizer;
            }
        }

        return null;
    }
}