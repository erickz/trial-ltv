<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\BaseApiController;
use App\Repositories\Contracts\UrlRepositoryInterface;
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
    public function __construct(UrlRepositoryInterface $topUrlRepository)
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

            $shortenedUrl = $this->repo->store(['original_url' => $url]);

            return response()->json([
                'error' => 200,
                'message' => 'URL shortened with success!',
                'data' => $shortenedUrl
            ]);
        }
        catch (Exception $e){
            return response()->json([
                'error' => $e->getCode(),
                'message' => $e->getMessage(),
                'data' => [],
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
