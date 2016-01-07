<?php

namespace XTeam\Console\Command;

use CL\Slack\Transport\ApiClient;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use XTeam\Infrastructure\InMemory\InMemoryMessageRepository;
use XTeam\Infrastructure\InMemory\InMemoryUserRepository;
use XTeam\Infrastructure\Slack\Notifier;
use XTeam\Infrastructure\Slack\UserRepository;
use XTeam\UseCase\PokeUser;
use XTeam\UseCase\PokeUser\Responder;

class PokeUserCommand extends Command implements Responder
{
    private $output;

    protected function configure()
    {
        $this
            ->setName('poke:user')
            ->setDescription('Pokes a random user with a random message on Slack')
            ->addArgument('channel', InputArgument::REQUIRED, 'name of the channel')
            ->addOption('test', null, InputOption::VALUE_NONE, 'Wether to run the command with test data')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->output = $output;

        $apiClient = new ApiClient('xoxb-17957916181-kbuGBaUeIVhxb7wxi6JXo1gP');
        $messageRepository = new InMemoryMessageRepository();
        $userRepository = new UserRepository($apiClient);
        if ($input->getOption('test')) {
            $userRepository = new InMemoryUserRepository();
        }
        $slackNotifier = new Notifier($apiClient, '#' . $input->getArgument('channel'));

        $useCase = new PokeUser($messageRepository, $userRepository, $slackNotifier);
        $useCase->execute(new PokeUser\Command(), $this);
    }

    public function userSuccessfullyPoked()
    {
        $this->output->writeln('User has been successfully poked!');
    }
}
