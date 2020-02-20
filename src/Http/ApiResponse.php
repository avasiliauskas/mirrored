<?php declare(strict_types=1);

namespace App\Http;

use Symfony\Component\HttpFoundation\JsonResponse;

class ApiResponse extends JsonResponse
{
    const OK_MESSAGE = 'OK';

    public function __construct(
        array $data = [],
        string $message = 'OK',
        array $errors = [],
        int $status = 200,
        array $headers = [],
        bool $json = false
    ) {
        parent::__construct($this->format($data, $message, $errors), $status, $headers, $json);
    }

    private function format(array $data, string $message, array $errors = []): array
    {
        return [
            'success' => true,
            'data' => $data,
            'message' => $message,
            'errors' => $errors,
        ];
    }

    public static function create($data = [], int $status = 200, array $headers = [])
    {
        return new static($data, self::OK_MESSAGE, [], $status, $headers);
    }
}