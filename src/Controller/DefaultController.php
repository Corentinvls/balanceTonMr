<?php
namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Gitlab\Client;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class DefaultController extends AbstractController {
    /**
     * @Route("/")
     * @return Response
     */
    public function index(Client $client) {
        $project = $client->projects()->all(["owned"=>true, "simple"=> true]);
        return new Response(var_dump($project));
    }
}