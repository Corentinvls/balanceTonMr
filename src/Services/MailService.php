<?php

/**
 * Appel de Mailer
 */

namespace App\Services;

use App\Repository\ProjectsRepository;
use App\Repository\UsersRepository;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Mailer\MailerInterface;

class MailService {

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

    public function sendNotifications() {

        $message = (new TemplatedEmail())
            ->from('s@gmail.com')
            ->to($this->usersRepository->findAll())
            ->subject('MR Notifications')
            ->htmlTemplate('emailNotification.html.twig')
            ->context([
                'projects' => $this->projectsRepository->findAll(),
                'requests' => $this->gitlabServices->getMergeRequestFromProject(21221266)
            ]);

        $this->mailer->send($message);

}}

