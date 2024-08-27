<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Validation\ValidationException;
use Throwable;
use Illuminate\Http\JsonResponse;

class Handler extends ExceptionHandler
{
    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Throwable  $exception
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Response
     */
    public function render($request, Throwable $exception)
    {
        // Check if the request expects JSON (for API responses)
        if ($request->expectsJson()) {
            // Handle validation exceptions separately
            if ($exception instanceof ValidationException) {
                return $this->convertValidationExceptionToResponse($exception, $request);
            }

            // For other types of exceptions, return a JSON response
            return response()->json([
                'message' => $exception->getMessage(),
                'status' => $this->isHttpException($exception) ? $exception->getStatusCode() : 500,
            ], $this->isHttpException($exception) ? $exception->getStatusCode() : 500);
        }

        // Fallback to parent method for non-JSON responses
        return parent::render($request, $exception);
    }

    /**
     * Convert a validation exception into a JSON response.
     *
     * @param  \Illuminate\Validation\ValidationException  $exception
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    protected function convertValidationExceptionToResponse(ValidationException $exception, $request)
    {
        $errors = $exception->errors();

        return new JsonResponse([
            'message' => 'The given data was invalid.',
            'errors' => $errors,
        ], $exception->status);
    }
}
