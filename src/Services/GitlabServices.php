<?php


namespace App\Services;


use Gitlab\Client;


class GitlabServices

{
    private $client;


    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function getAllProjects() {
        return $this->client->projects()->all(["owned"=>true]);
    }


    public function getMergeRequestFromProject (int $project_id) {
        return $this->client->mergeRequests()->all($project_id);
    }


}