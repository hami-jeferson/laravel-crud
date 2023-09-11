<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\JsonResponse;

class CustomValidationExceptionHandler extends Exception
{
    protected $validationException;

    public function __construct(ValidationException $validationException)
    {
        parent::__construct();
        $this->validationException = $validationException;
    }

    /**
     * Render the exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function render($request)
    {
        return $this->renderValidationException();
    }

    /**
     * Render the validation exception as a JSON response with a 403 status code.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function renderValidationException()
    {
        return JsonResponse::fromJsonString(
            json_encode([
                'success'=>false,
                'message' => 'Validation failed',
                'errors' => $this->validationException->errors(),
            ]),
            422
        );
    }
}
