<?php

namespace XTeam\Domain\Repository;

use XTeam\Domain\User;

interface MessageRepository
{
    public function getRandomMessageForUser(User $user);
}
