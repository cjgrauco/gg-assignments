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
            "useCdn" => false
        ]);
    }

    public function save(string $data){
        $document = [
            "_type" => "steamSearch",
            "info" => $data
        ];

        $newDocument = $this->sanityClient->create($document);
    }

    public function getAll(){
        try {
            return $this->sanityClient->fetch('*[_type == "steamSearch"][]');
        } catch (\Exception $e) {
            Log::error($e);
        }
        return null;
    }
}
