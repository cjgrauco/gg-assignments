<?php

namespace App\Repositories;

use Illuminate\Support\Facades\Log;
use Sanity\Client;

class SteamSearchRepository
{
    protected $sanityClient;

    public function __construct()
    {
        $this->sanityClient = new Client([
            "projectId" => env("SANITY_PROJECT_ID"),
            "dataset" => env("SANITY_DATASET"),
            "token" => env("SANITY_TOKEN"),
            "useCdn" => false,
            "apiVersion" => "2020-02-06"
        ]);
    }

    /**
     * Save steam search scrape result
     * @param string $data
     * @return bool
     */
    public function save(string $data): bool
    {
        $document = [
            "_type" => "steamSearch",
            "info" => $data
        ];

        $newDocument = $this->sanityClient->create($document);

        if (isset($newDocument["_id"])) {
            return true;
        }

        return false;
    }

    /**
     * Get latest steam search scrape result
     *
     * @return mixed|null
     */
    public function getLastest()
    {
        try {
            $response = $this->sanityClient->fetch('*[_type == "steamSearch"][0]{
            info
            }');

            return $response['info'];

        } catch (\Exception $e) {
            Log::error($e);
        }

        return null;
    }
}
