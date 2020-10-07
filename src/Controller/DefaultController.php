<?php
namespace App\Controller;


use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Gitlab\Client;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;


class DefaultController extends AbstractController {

    public function __construct(Environment $twig)
    {
        $this->twig = $twig;
    }

    /**
     * @Route("/")
     * @return Response
     */
    public function index(Client $client) {
        //$project = $client->projects()->all(["owned"=>true, "simple" => true]);
        //$content = $this->twig->render('projects/listProjects.html.twig', ['projects' => $project]);
        //return new Response(var_dump($project));

        $project = $client->mergeRequests()->all(21221266);
        $content = $this->twig->render('projects/mergeRequest.html.twig', ['requests' => $project]);
        return new Response ($content);
    }

}