<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\BaseApiController;
use App\Repositories\ShortenerRepository;
use Illuminate\Http\Request;
use Validator;

class ShortenerController extends BaseApiController
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    public function shortenUrl(Request $request): String
    {
        try
        {
            $url = $request->get("url");


        }
        catch (Exception $e){

        }

        return "";
    }
}
