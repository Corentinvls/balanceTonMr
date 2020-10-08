<?php

namespace App\Controller;


use App\Entity\Projects;
use App\Services\GitlabServices;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Gitlab\Client;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;


class DefaultController extends AbstractController
{

    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    public function __construct(Environment $twig, EntityManagerInterface $entityManager)
    {
        $this->twig = $twig;
        $this->entityManager = $entityManager;
    }

    /**
     * @Route("/")
     * @return Response
     */
    public function index()
    {
        //$project = $client->projects()->all(["owned"=>true, "simple" => true]);
        //$content = $this->twig->render('projects/listProjects.html.twig', ['projects' => $project]);
        //return new Response(var_dump($project));

        //  $project = $client->mergeRequests()->all(21221266);
        //  $content = $this->twig->render('projects/mergeRequest.html.twig', ['requests' => $project]);
        $result =$this->entityManager->getRepository(Projects::class)->findBy(['gitLabId'=>21522457]);
        return new Response ();
    }

}