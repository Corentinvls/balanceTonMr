<?php

namespace App\Controller;

use App\Entity\Projects;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;
use Gitlab\Client;
use App\Services\GitlabServices;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route ("/project")
 */
class ProjectController extends AbstractController {

    /**
     * ProjectController constructor.
     * @param Environment $twig
     * @param GitlabServices $gitlabServices
     */

    public function __construct(Environment $twig, GitlabServices $gitlabServices, Client $client)
    {
        $this->client = $client;
        $this->twig = $twig;
        $this->gitlabServices = $gitlabServices;
    }

    /**
     * @Route("/", name="project_index")
     */
    public function index() {
        $project = $this->gitlabServices->getAllProjects();
        $content = $this->twig->render('projects/listProjects.html.twig', ['projects' => $project]);
        return new Response($content);

    }

    /**
     * @Route("/{gitLabId}", name="project_details", methods={"GET"})
     * @param Request $request
     * @return Response
     */
    public function mergeRequestsDetails(Projects $project) {

        //return $project;

        return $this->render('projects/mergeRequest.html.twig', [
            'requests' => $project,
        ]);

        //$allMergeRequest = $this->client->mergeRequests()->all($listProjects);
        //$listMerge = $this->gitlabServices->getMergeRequestFromProject($id);
        //$content = $this->twig->render('projects/mergeRequest.html.twig', ['requests' => $allMergeRequest]);
        //return new Response($content);
    }



}