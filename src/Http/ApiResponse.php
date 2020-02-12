<?php

namespace App\Http;

use Symfony\Component\HttpFoundation\JsonResponse;

class ApiResponse extends JsonResponse
{
    public function __construct(string $message, array $errors = [], int $status = 200, array $headers = [], bool $json = false)
    {
        parent::__construct($this->format($message, $errors), $status, $headers, $json);
    }

    private function format(string $message,  array $errors = [])
    {
        $response = ['message' => $message];

        if ($errors) {
            $response['errors'] = $errors;
        }

        return $response;
    }
}