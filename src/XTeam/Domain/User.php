<?php

namespace XTeam\Domain;

use CL\Slack\Model\User as SlackUser;

final class User
{
    const PRESENCE_ACTIVE = 'active';

    private $id;
    private $username;

    public function __construct($id, $username)
    {
        $this->id = $id;
        $this->username = $username;
    }

    public static function fromSlack(SlackUser $user)
    {
        $user = new self($user->getId(), $user->getName());

        return $user;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getUsername()
    {
        return $this->username;
    }
}
