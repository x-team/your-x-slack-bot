<?php

namespace XTeam\Infrastructure\InMemory;

use XTeam\Domain\Message;
use XTeam\Domain\Repository\MessageRepository;
use XTeam\Domain\User;

class InMemoryMessageRepository implements MessageRepository
{
    private $messages = [
        'Where ya working at %USERNAME%?! Snap a photo of your desk :)!',
        'Read any cool blog posts lately %USERNAME%? Share the love',
        'Any interesting book on your shelves %USERNAME%?',
        'Seen any good movie lately %USERNAME%?',
        'Any good TV Series you would recommend %USERNAME%?'
    ];

    public function getRandomMessageForUser(User $user)
    {
        return new Message(str_replace(
            '%USERNAME%',
            '@' . $user->getUsername(),
            $this->messages[array_rand($this->messages)]
        ));
    }
}
