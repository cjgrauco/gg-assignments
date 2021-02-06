<?php

namespace App\Services;

use App\Repositories\SteamSearchRepository;
use DateTime;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Facades\Log;
use Symfony\Component\DomCrawler\Crawler;

class ScrapingService
{
    protected $guzzleClient;
    protected $crawler;
    protected $steamSearchRepository;

    public function __construct()
    {
        $this->guzzleClient = new Client();
        $this->crawler = new Crawler();
        $this->steamSearchRepository = new SteamSearchRepository();
    }

    public function getSteamSearchBody(): ?string
    {
        try {

            $response = $this->guzzleClient->get('https://store.steampowered.com/search/?maxprice=90&tags=5350&category1=998&supportedlang=norwegian');
            return $response->getBody()->getContents();

        } catch (GuzzleException $e) {
            Log::error($e);
        }

        return null;
    }

    public function crawlSteamSearchBody(string $body): array
    {
        $returnArray = [];

        $this->crawler->addHtmlContent($body);

        $gamesInfo = $this->crawler->filterXPath('//div[@id="search_resultsRows"]/a')->each(function (Crawler $node){
            $title = $node->filterXPath('//span[@class="title"]')->text();
            $hasPositiveReview = $node->filterXPath('//span[@class="search_review_summary positive"]')->count() > 0;
            $releaseDate = $node->filterXPath('//div[@class="col search_released responsive_secondrow"]')->text();
            $imageUrl = $node->filterXPath('//img')->attr("src");
            $price = $node->filterXPath('//div[contains(@class, " search_price ")]')->text();

            $priceSplit = array_filter(explode(" kr", $price));

            if (stripos($title, "a") !== false || !$hasPositiveReview) {
                return null;
            }

            return [
                "title" => $title,
                "imageUrl" => $imageUrl,
                "releaseDate" => DateTime::createFromFormat("d M, Y",$releaseDate)->format("d/m/Y"),
                "priceNOK" => $priceSplit[1] ?? $priceSplit[0],
            ];
        });


        foreach ($gamesInfo as $gameInfo) {
            if ($gameInfo !== null) {
                $returnArray[] = $gameInfo;
            }
        }

        //$this->steamSearchRepository->save(json_encode($returnArray, JSON_THROW_ON_ERROR));
        return $returnArray;
    }
}
