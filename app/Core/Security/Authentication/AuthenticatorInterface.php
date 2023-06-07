<?php

namespace App\Core\Security\Authentication;

interface AuthenticatorInterface
{
    public function getUser();

    public function login(string $email, string $password);
}