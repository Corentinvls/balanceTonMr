<?php

namespace App\Controller;

use App\Entity\Projects;
use App\Form\ProjectsType;
use App\Repository\ProjectsRepository;
use Gitlab\Client;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Services\GitlabServices;
use Twig\Environment;

/**
 * @Route("/projects")
 */
class ProjectsController extends AbstractController
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
     * @Route("/", name="projects_index", methods={"GET"})
     */
    public function index(ProjectsRepository $projectsRepository): Response
    {
        $this->gitlabServices->getAllProjects();
        return $this->render('projects/index.html.twig', [
            'projects' => $projectsRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="projects_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $project = new Projects();
        $form = $this->createForm(ProjectsType::class, $project);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($project);
            $entityManager->flush();

            return $this->redirectToRoute('projects_index');
        }

        return $this->render('projects/new.html.twig', [
            'project' => $project,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{gitLabId}", name="projects_show", methods={"GET"})
     */
    public function show(Projects $project): Response
    {
        return $this->render('projects/show.html.twig', [
            'project' => $project,
        ]);
    }

    /**
     * @Route("/{gitLabId}/mergerequests", name="projects_show", methods={"GET"})
     */
    public function mergeRequestList(Projects $project, Request $request, GitlabServices $gitlabServices): Response
    {
        $project_id = $request->get("gitLabId");
        $listMerge = $gitlabServices->getMergeRequestFromProject($project_id);
        return $this->render('projects/mergeRequest.html.twig', [
            'requests' => $listMerge,
            'project' => $project,
        ]);
    }

    /**
     * @Route("/{gitLabId}/edit", name="projects_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Projects $project): Response
    {
        $form = $this->createForm(ProjectsType::class, $project);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('projects_index');
        }

        return $this->render('projects/edit.html.twig', [
            'project' => $project,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{gitLabId}", name="projects_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Projects $project): Response
    {
        if ($this->isCsrfTokenValid('delete' . $project->getGitLabId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($project);
            $entityManager->flush();
        }

        return $this->redirectToRoute('projects_index');
    }
}
