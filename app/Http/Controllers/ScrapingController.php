<?php

namespace App\Http\Controllers;


use App\Services\ScrapingService;

class ScrapingController extends Controller
{
    protected $scrapingService;
    public function __construct(ScrapingService $scrapingService)
    {
    }

    public function scrape()
    {
        return "scraped";
    }
}
