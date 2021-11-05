<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\BaseApiController;
use App\Repositories\Contracts\TopUrlRepositoryInterface;
use Exception;
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

    public function shortenUrl(Request $request, $redirect = null)
    {
        try
        {
            $url = $request->get("url");

            if (! $url){
                throw new Exception('Please provide a URL');
            }

            if (strpos($url, 'http') !== 0) {
                $url = 'http://' .  $url;
            }

            if (filter_var($url, FILTER_VALIDATE_URL) === false){
                throw new Exception("URL IS NOT VALID");
            }
        }
        catch (Exception $e){
            return response()->json([
                'error' => $e->getCode(),
                'message' => $e->getMessage()
            ]);
        }

        return "";
    }

    /**
     * Get the top 100 most accessed URLS
     * @return string
     */
    public function getTopUrls()
    {
        try
        {
            $this->repo->getTop100();
        }
        catch (Exception $e){

        }

        return "";
    }
}
