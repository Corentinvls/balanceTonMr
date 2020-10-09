<?php
namespace App\Command;
use App\Services\MailService;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
class EmailNotificationCommand extends Command
{
    protected static $defaultName = 'email';
    /**
     * @var MailService
     */
    private $mailService;
    public function __construct( MailService $mailService)
    {
        $this->mailService = $mailService;
        parent::__construct();
    }
    protected function configure()
    {
        $this->setDescription('Send email.....');
    }
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $this->mailService->sendNotifications();
        $output->writeln('Email send');
        return Command::SUCCESS;
    }
}
