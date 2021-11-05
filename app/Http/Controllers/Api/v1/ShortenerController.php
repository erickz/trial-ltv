<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\BaseApiController;
use App\Repositories\Contracts\TopUrlRepositoryInterface;
use Illuminate\Http\Request;
use Validator;

class ShortenerController extends BaseApiController
{
    private $repo;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(TopUrlRepositoryInterface $topUrlRepository)
    {
        $this->repo = $topUrlRepository;
    }

    public function shortenUrl(Request $request): String
    {
        try
        {
            $url = $request->get("url");

            $this->repo->something();
        }
        catch (Exception $e){

        }

        return "";
    }
}
