<?php

namespace App\Controller;

use App\Entity\Team;
use App\Entity\Users;
use App\Form\TeamType;
use App\Repository\ProjectsRepository;
use App\Repository\TeamRepository;
use App\Repository\UsersRepository;
use App\Services\GitlabServices;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;

/**
 * @Route("/team")
 */
class TeamController extends AbstractController
{
    /**
     * @var GitlabServices
     */
    private $gitlabServices;

    public function __construct(GitlabServices $gitlabServices)
    {
        $this->gitlabServices = $gitlabServices;
    }

    /**
     * @Route("/", name="team_index", methods={"GET"})
     */
    public function index(TeamRepository $teamRepository): Response
    {
        return $this->render('team/index.html.twig', [
            'teams' => $teamRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="team_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $team = new Team();
        $form = $this->createForm(TeamType::class, $team);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($team);
            $entityManager->flush();

            return $this->redirectToRoute('team_index');
        }

        return $this->render('team/new.html.twig', [
            'team' => $team,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="team_show", methods={"GET"})
     */
    public function show(Team $team, UsersRepository $usersRepository, Request $request, Users $users): Response
    {
        $teamId = $request->get("id");
        var_dump($teamId);
        $projects = $team->getProjects();
        $projectsGitLabId = [];
        foreach ($projects as $project) {
            $projectsGitLabId[$project->getGitLabId()] = $this->gitlabServices->getMergeRequestFromProject($project->getGitLabId());
        }
        return $this->render('team/show.html.twig', [
            'team' => $team,
            'gitLabIds' => $projectsGitLabId,
            'users' => $usersRepository->findBy(
                ['team' => $teamId]
            )
        ]);
    }

    /**
     * @Route("/{id}/edit", name="team_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Team $team): Response
    {
        $form = $this->createForm(TeamType::class, $team);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('team_index');
        }

        return $this->render('team/edit.html.twig', [
            'team' => $team,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="team_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Team $team): Response
    {
        if ($this->isCsrfTokenValid('delete' . $team->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($team);
            $entityManager->flush();
        }

        return $this->redirectToRoute('team_index');
    }
}
