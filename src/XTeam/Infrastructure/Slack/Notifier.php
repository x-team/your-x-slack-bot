<?php

namespace XTeam\Infrastructure\Slack;

use CL\Slack\Payload\ChatPostMessagePayload;
use CL\Slack\Transport\ApiClient;
use XTeam\Domain\Message;
use XTeam\Domain\Notifications\SlackNotifier;

class Notifier implements SlackNotifier
{
    private $apiClient;

    private $channel;

    public function __construct(ApiClient $apiClient, $channel)
    {
        $this->apiClient = $apiClient;
        $this->channel = $channel;
    }

    public function send(Message $message)
    {
        $payload = new ChatPostMessagePayload();
        $payload->setChannel($this->channel);
        $payload->setUsername('Your X');
        $payload->setIconUrl('https://avatars.slack-edge.com/2016-01-07/17979318133_8214b25cb250e363ff1a_48.png');
        $payload->setLinkNames(true);
        $payload->setText($message->getText());

        $this->apiClient->send($payload);
    }
}
