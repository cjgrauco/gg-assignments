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

    public function save(string $data){
        $document = [
            "_type" => "steamSearch",
            "info" => $data
        ];

        $newDocument = $this->sanityClient->create($document);

        if (isset($newDocument["_id"])){
            return true;
        }

        return false;
    }

    public function getLastest(){
        try {
            $response = $this->sanityClient->fetch('*[_type == "steamSearch"][0]{
            info,
            _createdAt
            }');
            return $response['info'];
        } catch (\Exception $e) {
            Log::error($e);
        }
        return null;
    }
}
