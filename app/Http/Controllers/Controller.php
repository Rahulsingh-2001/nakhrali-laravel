<?php

namespace App\Http\Controllers;

use Http;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Response;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function successResponse($data = [])
    {
        return response()->json($data);
    }
    public function errorResponse($data = [])
    {
        return response()->json($data);
    }
}
