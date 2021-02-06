<?php

namespace App\Http\Controllers;

use App\Repositories\SteamSearchRepository;
use App\Services\ScrapingService;

class ScrapingController extends Controller
{
    protected $scrapingService;
    protected $steamSearchRepository;

    public function __construct(ScrapingService $scrapingService)
    {
        $this->scrapingService = $scrapingService;
        $this->steamSearchRepository = new SteamSearchRepository();
    }

    public function scrapeSteamSearch()
    {
        $body = $this->scrapingService->getSteamSearchBody();

        if ($body === null) {
            return response("Fetching steam search page failed", 500);
        }

        $crawlSuccessful = $this->scrapingService->crawlAndSaveSteamSearch($body);

        if ($crawlSuccessful) {
            return response("Crawl succesful");
        }

        return response("Crawl failed", 500);
    }

    public function getSteamSearchResult()
    {
        return response($this->steamSearchRepository->getLastest())
            ->header("Content-Type", "application/json");
    }
}
