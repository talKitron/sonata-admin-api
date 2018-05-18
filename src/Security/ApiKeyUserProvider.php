<?php

namespace App\Security;

use App\Repository\UserRepository;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Core\User\User;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;

class ApiKeyUserProvider implements UserProviderInterface
{
    /**
     * @var UserRepository
     */
    private $repository;

    /**
     * ApiKeyUserProvider constructor.
     * @param UserRepository $repository
     */
    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    public function getUsernameForApiKey($apiKey)
    {
        $user = $this->repository->findOneByToken($apiKey);

        return $user ? $user->getUsername() : null;
    }

    public function loadUserByUsername($username)
    {
        $user = $this->repository->findOneByUsername($username);

        return new User(
            $user->getUsername(),
            null,
            // the roles for the user - you may choose to determine
            // these dynamically somehow based on the user
            $user->getRoles()
        );
    }

    public function refreshUser(UserInterface $user)
    {
        // this is used for storing authentication in the session
        // but in this example, the token is sent in each request,
        // so authentication can be stateless. Throwing this exception
        // is proper to make things stateless
        throw new UnsupportedUserException();
    }

    public function supportsClass($class)
    {
        return User::class === $class;
    }
}
