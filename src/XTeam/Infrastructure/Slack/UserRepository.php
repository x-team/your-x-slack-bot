<?php

namespace XTeam\Infrastructure\Slack;

use CL\Slack\Payload\UsersGetPresencePayload;
use CL\Slack\Payload\UsersListPayload;
use CL\Slack\Transport\ApiClient;
use XTeam\Domain\Repository\UserRepository as UserRepositoryInterface;
use XTeam\Domain\User;

class UserRepository implements UserRepositoryInterface
{
    const RANDOM_ATTEMPTS_LIMIT = 75;

    /**
     * @var ApiClient
     */
    private $apiClient;

    /**
     * UserRepository constructor.
     * @param ApiClient $apiClient
     */
    public function __construct(ApiClient $apiClient)
    {
        $this->apiClient = $apiClient;
    }

    public function getRandomActiveUser()
    {
        $payload = new UsersGetPresencePayload();
        $attemptsCount = 0;

        while (true) {
            if (++$attemptsCount == self::RANDOM_ATTEMPTS_LIMIT) {
                break;
            }

            $user = $this->getRandomUser();

            $payload->setUserId($user->getId());

            $response = $this->apiClient->send($payload);
            $presence = $response->getPresence();

            if ($presence == User::PRESENCE_ACTIVE) {
                return $user;
            }
        }
    }

    private function getRandomUser()
    {
        $payload = new UsersListPayload();

        $response = $this->apiClient->send($payload);

        $users = $response->getUsers();
        $user = $users[array_rand($users)];

        return User::fromSlack($user);
    }
}
