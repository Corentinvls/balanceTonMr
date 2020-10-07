<?php

namespace App\Controller;

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

    public function __construct(Environment $twig, GitlabServices $gitlabServices)
    {
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
     * @Route("/details", name="project_details")
     */

    public function mergeRequestsDetails() {
        $listMerge = $this->gitlabServices->getMergeRequestFromProject(21221266);
        $content = $this->twig->render('projects/mergeRequest.html.twig', ['requests' => $listMerge]);
        return new Response($content);
    }


}