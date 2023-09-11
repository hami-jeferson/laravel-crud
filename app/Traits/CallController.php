<?php
namespace App\Traits;

use \Illuminate\Http\Request;
trait CallController{
    public function fetch($route, $method = 'Get')
    {
        $request = Request::create($route, $method);
        $response = app()->handle($request);
        return json_decode($response->getContent(), true);
    }
}
