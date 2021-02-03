<?php


namespace App\Services;


use GuzzleHttp\Client;

class ScrapingService
{
    protected $guzzleClient;
    public function __construct()
    {
        $this->guzzleClient = new Client();
    }

    public function scrapeUrl(string $url)
    {
        $response = $this->guzzleClient->get($url);
        return $response->getBody()->getContents();
    }
}
