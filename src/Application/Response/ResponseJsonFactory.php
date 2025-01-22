<?php

namespace App\Application\Response;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class ResponseJsonFactory
{
    public function createSuccessResponse(array $data = null, array $meta = null): Response
    {
        $responseData = [
            'success' => true,
        ];

        if ($data !== null) {
            $responseData['data'] = $data;
        }

        return $this->createJsonResponse($responseData);
    }

    public function createFailureResponse(array $errors = []): Response
    {
        $responseData = [
            'success' => false,
            'errors'  => $errors,
        ];

        return $this->createJsonResponse($responseData);
    }

    protected function createJsonResponse(array $data): JsonResponse
    {
        return (new JsonResponse($data));
    }
}