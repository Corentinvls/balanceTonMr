<?php


namespace App\Services;


use App\Entity\Articles;
use App\Entity\Projects;
use App\Repository\ProjectsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Gitlab\Client;


class GitlabServices

{
    private $client;
    private $entityManager;
    private $projectsRepository;


    public function __construct(Client $client, EntityManagerInterface $entityManager, ProjectsRepository $projectsRepository)
    {
        $this->client = $client;
        $this->entityManager = $entityManager;
        $this->projectsRepository = $projectsRepository;
    }

    public function getAllProjects()
    {
        $allProjects = $this->client->projects()->all(["owned" => true]);
        foreach ($allProjects as $project) {
            if (!$this->projectsRepository->findBy(['gitLabId' => $project['id']])) {
                $newProject = new Projects();
                $newProject->setGitLabId($project['id']);
                $newProject->setName($project['name']);
                $this->entityManager->persist($newProject);
                $this->entityManager->flush();
            }
        }

        return $allProjects;

    }


    public function getMergeRequestFromProject(int $project_id)
    {
        return $this->client->mergeRequests()->all($project_id);
    }

    public function getEntityManager()
    {
        return $this->entityManager->getRepository(Projects::class);
    }

    public function getDbProjects(int $project_id)
    {
        return $this->getEntityManager()->findBy(['gitLabId' => $project_id]);
    }

}