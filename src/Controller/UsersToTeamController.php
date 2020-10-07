<?php

namespace App\Controller;

use App\Entity\UsersToTeam;
use App\Form\UsersToTeamType;
use App\Repository\UsersToTeamRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/usersToTeam")
 */
class UsersToTeamController extends AbstractController
{
    /**
     * @Route("/", name="users_to_team_index", methods={"GET"})
     */
    public function index(UsersToTeamRepository $usersToTeamRepository): Response
    {
        return $this->render('users_to_team/index.html.twig', [
            'users_to_teams' => $usersToTeamRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="users_to_team_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $usersToTeam = new UsersToTeam();
        $form = $this->createForm(UsersToTeamType::class, $usersToTeam);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($usersToTeam);
            $entityManager->flush();

            return $this->redirectToRoute('users_to_team_index');
        }

        return $this->render('users_to_team/new.html.twig', [
            'users_to_team' => $usersToTeam,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="users_to_team_show", methods={"GET"})
     */
    public function show(UsersToTeam $usersToTeam): Response
    {
        return $this->render('users_to_team/show.html.twig', [
            'users_to_team' => $usersToTeam,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="users_to_team_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, UsersToTeam $usersToTeam): Response
    {
        $form = $this->createForm(UsersToTeamType::class, $usersToTeam);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('users_to_team_index');
        }

        return $this->render('users_to_team/edit.html.twig', [
            'users_to_team' => $usersToTeam,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="users_to_team_delete", methods={"DELETE"})
     */
    public function delete(Request $request, UsersToTeam $usersToTeam): Response
    {
        if ($this->isCsrfTokenValid('delete'.$usersToTeam->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($usersToTeam);
            $entityManager->flush();
        }

        return $this->redirectToRoute('users_to_team_index');
    }
}
