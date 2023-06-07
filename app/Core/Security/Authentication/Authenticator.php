<?php

namespace App\Core\Security\Authentication;

use App\Core\Entity\User;
use Doctrine\ORM\EntityManagerInterface;

class Authenticator implements AuthenticatorInterface
{

    private ?User $user = null;

    public function __construct(
        private readonly EntityManagerInterface $entityManager
    )
    {
    }

    public function getUser() : ?User
    {
        if ($this->user !== null) {
            return $this->user;
        }

        $userId = $_SESSION['userId'];

        if (!$userId) {
            return null;
        }

        $user = $this->entityManager->getRepository(User::class)->find($userId);

        if (!$user) {
            return null;
        }

        $this->user = $user;

        return $user;
    }

    public function login(string $email, string $password): bool
    {
        $user = $this->entityManager->getRepository(User::class)->findOneBy([
            'email' => $email
        ]);

        if (!$user){
            return false;
        }

        if (!password_verify($password, $user->getPassword())) {
            return false;
        }

        $_SESSION['userId'] = $user->getId();

        return true;
    }
}