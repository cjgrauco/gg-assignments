<?php

namespace App\Http\Controllers;
use App\Services\ScrapingService;

class ScrapingController extends Controller
{
    protected $scrapingService;

    public function __construct(ScrapingService $scrapingService)
    {
        $this->scrapingService = $scrapingService;
    }

    public function scrape()
    {
        return "Lol";
        $body = $this->scrapingService->getSteamSearchBody();

        if ($body === null) {
            return null;
        }

        $gamesInfoArray = $this->scrapingService->crawlSteamSearchBody($body);

        return $gamesInfoArray;
    }
}
