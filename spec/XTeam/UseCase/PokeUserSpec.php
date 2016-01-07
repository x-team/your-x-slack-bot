<?php

namespace spec\XTeam\UseCase;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use XTeam\Domain\Message;
use XTeam\Domain\Notifications\SlackNotifier;
use XTeam\Domain\Repository\MessageRepository;
use XTeam\Domain\Repository\UserRepository;
use XTeam\Domain\User;
use XTeam\UseCase\PokeUser\Command;
use XTeam\UseCase\PokeUser\Responder;

class PokeUserSpec extends ObjectBehavior
{
    function let(
        MessageRepository $messageRepository,
        UserRepository $userRepository,
        SlackNotifier $slackNotifier
    ) {
        $this->beConstructedWith($messageRepository, $userRepository, $slackNotifier);
    }

    function it_should_retrieve_a_random_message_for_a_random_user_and_poke_him(
        MessageRepository $messageRepository,
        UserRepository $userRepository,
        SlackNotifier $slackNotifier,
        Responder $responder
    ) {
        $userRepository->getRandomUser()->willReturn($user = new User());

        $messageRepository->getRandomMessageForUser($user)->willReturn($message = new Message('Test message'));

        $slackNotifier->send($message)->shouldBeCalled();

        $responder->userSuccessfullyPoked()->shouldBeCalled();

        $this->execute(new Command(), $responder);
    }
}
