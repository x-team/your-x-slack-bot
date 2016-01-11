<?php

namespace XTeam\Infrastructure\InMemory;

use XTeam\Domain\Repository\UserRepository;
use XTeam\Domain\User;

class InMemoryUserRepository implements UserRepository
{
    public function getRandomActiveUser()
    {
        return new User('test', 'karolsojko');
    }
}
