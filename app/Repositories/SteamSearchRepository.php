<?php
namespace App\Repositories;
use Sanity\Client;

class SanityRepository
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

    }
}
