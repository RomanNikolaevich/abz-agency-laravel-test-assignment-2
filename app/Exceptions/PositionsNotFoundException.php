<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\JsonResponse;

class PositionsNotFoundException extends Exception
{
    public function __construct($message = 'Positions not found', $code = 0, Exception $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }

    public function render(): JsonResponse
    {
        return response()->json([
            'success' => false,
            'message' => $this->getMessage(),
        ], 404);
    }
}
