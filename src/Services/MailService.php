<?php

/**
 * Appel de Mailer
 */

namespace App\Services;

use App\Entity\Projects;
use App\Entity\Team;
use App\Entity\Users;
use Gitlab\Model\User;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Mailer\MailerInterface;

class MailService {

    public function __construct(MailerInterface $mailer)
    {
        $this->mailer = $mailer;
    }

    public function getProjectIdForMail(Projects $projects, Team $team, Users $users) {

    }


    public function sendNotifications() {

        $message = (new TemplatedEmail())
            ->from('s@gmail.com')
            ->to('laaurentsem@gmail.com')
            ->subject('MR Notifications')
            ->htmlTemplate('emailNotification.html.twig');

        $this->mailer->send($message);

}}

