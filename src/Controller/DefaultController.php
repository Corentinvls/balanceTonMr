<?php

namespace App\Controller;


use App\Entity\Projects;
use App\Repository\ProjectsRepository;
use App\Repository\TeamRepository;
use App\Repository\UsersRepository;
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
    private $teamRepository;
    private $projectsRepository;
    /**
     * @var Environment
     */
    private $twig;
    /**
     * @var UsersRepository
     */
    private $usersRepository;

    public function __construct(
        Environment $twig,
        EntityManagerInterface $entityManager,
        ProjectsRepository $projectsRepository,
        TeamRepository $teamRepository,
        UsersRepository $usersRepository
    )
    {
        $this->twig = $twig;
        $this->entityManager = $entityManager;
        $this->projectsRepository = $projectsRepository;
        $this->teamRepository = $teamRepository;
        $this->usersRepository = $usersRepository;
    }

    /**
     * @Route("/")
     * @return Response
     */
    public function index()
    {
        return $this->render('dashboard.html.twig', [
            'teams' => $this->teamRepository->findAll(),
            'projects' => $this->projectsRepository->findAll(),

        ]);
    }

}