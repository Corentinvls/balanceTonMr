<?php


namespace App\Services;


use App\Entity\Projects;
use Doctrine\ORM\EntityManagerInterface;
use Gitlab\Client;


class GitlabServices

{
    private $client;
    private $entityManager;


    public function __construct(Client $client, EntityManagerInterface $entityManager)
    {
        $this->client = $client;
        $this->entityManager = $entityManager;
    }

    public function getAllProjects()
    {
        $allProjects = $this->client->projects()->all(["owned" => true]);

        foreach ($allProjects as $project) {
            $newProject = new Projects();
             $newProject->setGitLabId($project['id']);
            $newProject->setName($project['name']);
            $this->entityManager->persist($newProject);
            $this->entityManager->flush();
        }

        return $allProjects;

    }


    public function getMergeRequestFromProject(int $project_id)
    {
        return $this->client->mergeRequests()->all($project_id);
    }


}