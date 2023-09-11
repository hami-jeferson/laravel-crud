<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

/**
 * @OA\Info(
 *      title="Laravel API Documentation",
 *      version="1.0.0",
 *      description="This is the API documentation for the Laravel application.",
 *      @OA\Contact(
 *          email="hami.sparow@gmail.com"
 *      ),
 *      @OA\License(
 *          name="MIT License",
 *          url="https://opensource.org/licenses/MIT"
 *      )
 * )
 * */
class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;
}
