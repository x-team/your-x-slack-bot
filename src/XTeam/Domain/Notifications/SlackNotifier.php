<?php

namespace XTeam\Domain\Notifications;

use XTeam\Domain\Message;

interface SlackNotifier
{
    public function send(Message $message);
}
