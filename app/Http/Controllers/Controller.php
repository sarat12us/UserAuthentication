<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesResources;

class Controller extends BaseController
{
    use AuthorizesRequests, AuthorizesResources, DispatchesJobs, ValidatesRequests;
    const RECORD_PER_PAGE = 10;
    const HTTP_CODE_SUCCESS = 200;
    const HTTP_CODE_AUTH_FAIL = 401;
    const HTTP_CODE_APP_ERROR = 403;
    const HTTP_CODE_BAD_REQUEST = 400;
    const HTTP_CODE_SERVER_ERROR = 500;
}
