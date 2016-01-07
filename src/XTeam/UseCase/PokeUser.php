<?php

namespace XTeam\UseCase;

use XTeam\Domain\Notifications\SlackNotifier;
use XTeam\Domain\Repository\MessageRepository;
use XTeam\Domain\Repository\UserRepository;
use XTeam\UseCase\PokeUser\Command;
use XTeam\UseCase\PokeUser\Responder;

class PokeUser
{
    /**
     * @var MessageRepository
     */
    private $messageRepository;

    /**
     * @var UserRepository
     */
    private $userRepository;

    /**
     * @var SlackNotifier
     */
    private $slackNotifier;

    /**
     * PokeUser constructor.
     * @param MessageRepository $messageRepository
     * @param UserRepository $userRepository
     * @param SlackNotifier $slackNotifier
     */
    public function __construct(
        MessageRepository $messageRepository,
        UserRepository $userRepository,
        SlackNotifier $slackNotifier
    ) {
        $this->messageRepository = $messageRepository;
        $this->userRepository = $userRepository;
        $this->slackNotifier = $slackNotifier;
    }

    public function execute(Command $command, Responder $responder)
    {
        $user = $this->userRepository->getRandomUser();

        $message = $this->messageRepository->getRandomMessageForUser($user);

        $this->slackNotifier->send($message);

        $responder->userSuccessfullyPoked();
    }
}
