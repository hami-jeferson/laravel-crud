<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class CustomModelNotFoundException extends ModelNotFoundException
{
    public function __construct($model, $ids = [], $message = null, $code = 0)
    {
        $message = $message ?: "The {$model} with the given ID(s) was not found.";

        parent::__construct($message, $code);

        $this->model = $model;
        $this->ids = $ids;
    }
}
