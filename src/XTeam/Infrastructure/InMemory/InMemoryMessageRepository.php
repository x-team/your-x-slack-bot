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
        'Any good TV Series you would recommend %USERNAME%?',
        'All foodies here right? %USERNAME% snap a photo and show us your breakfast/lunch/dinner today :)!',
        'I love me some good old gaming time, any recommendations %USERNAME%?',
        'It\'s time for me to focus - %USERNAME% any good music album you would recommend?'
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
