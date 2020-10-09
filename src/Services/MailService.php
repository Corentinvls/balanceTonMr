<?php

/**
 * Appel de Mailer
 */

namespace App\Services;

use App\Entity\Users;
use App\Repository\ProjectsRepository;
use App\Repository\UsersRepository;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Mailer\MailerInterface;

class MailService
{

    private $projectsRepository;
    private $gitlabServices;
    private $usersRepository;


    public function __construct(MailerInterface $mailer, ProjectsRepository $projectsRepository, GitlabServices $gitlabServices, UsersRepository $usersRepository)
    {
        $this->mailer = $mailer;
        $this->projectsRepository = $projectsRepository;
        $this->gitlabServices = $gitlabServices;
        $this->usersRepository = $usersRepository;
    }

    public function sendNotifications()
    {

        $users = $this->usersRepository->findAll();
        foreach ($users as $user) {
            $email = $user->getEmail();
            $team = $user->getTeam();
            $context = [];
            foreach ($team->getProjects() as $projectId) {
                array_push($context, $this->gitlabServices->getMergeRequestFromProject($projectId->getGitLabId()));
            }

            // $projects = $this->projectsRepository->findAll();
            if (count($context) > 0) {
                $message = (new TemplatedEmail())
                    ->from('s@gmail.com')
                    ->to($email)
                    ->cc('laaurentsem@gmail.com')
                    ->subject('MR Notifications')
                    ->htmlTemplate('emailNotification.html.twig')
                    ->context([
                        'requests' => $context
                    ]);
                $this->mailer->send($message);
            }

        }


    }
}

