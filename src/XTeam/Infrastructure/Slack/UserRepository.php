<?php

namespace XTeam\Infrastructure\Slack;

use CL\Slack\Payload\UsersListPayload;
use CL\Slack\Transport\ApiClient;
use XTeam\Domain\Repository\UserRepository as UserRepositoryInterface;
use XTeam\Domain\User;

class UserRepository implements UserRepositoryInterface
{
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

    public function getRandomUser()
    {
        $payload = new UsersListPayload();

        $response = $this->apiClient->send($payload);

        $users = $response->getUsers();
        $user = $users[array_rand($users)];

        return new User($user->getName());
    }
}
