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

    public function shortenOrRedirectUrl(Request $request, $hash = null)
    {
        try
        {
            //First check if the page must to be redirected or shorten an URL
            if ($hash) {

                $url = $this->repo->findByHash($hash);

                if (! $url){
                    throw new Exception("Couldn't find any shortened url with this hash");
                }

                if ($this->repo->increaseAccessCount($url)) {
                    return redirect($url->original_url, 301);
                }
            }

            $url = $request->get("url");

            if (! $url){
                throw new Exception('Please provide a URL');
            }

            if (strpos($url, 'www') === false) {
                throw new Exception('Please provide a valid URL');
            }

            //If the url doesn't contain http, add to it
            if (strpos($url, 'http') !== 0) {
                $url = 'http://' .  $url;
            }

            if (filter_var($url, FILTER_VALIDATE_URL) === false){
                throw new Exception("The provided URL is not valid");
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
            $top100Urls = $this->repo->getTop100();

            return response()->json([
                'error' => 200,
                'message' => '',
                'data' => $top100Urls,
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

    public function topUrlsView()
    {
        return view('topurls');
    }
}
