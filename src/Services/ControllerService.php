<?php


namespace App\Services;


use App\Entity\Team;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class ControllerService extends AbstractController
{
    private $team;

    public function inForm($team){
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($team);
        $entityManager->flush();
        $resTeam= $this->redirectToRoute('team_index');
        return $resTeam;
    }
}