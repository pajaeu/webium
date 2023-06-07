<?php

namespace App\Core\Entity;

use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\Table;

#[Table(name: 'users')]
#[Entity]
class User
{

    #[Column(name: 'id', type: 'integer', nullable: false)]
    #[Id]
    #[GeneratedValue(strategy: 'AUTO')]
    private int $id;

    #[Column(name: 'email', type: 'string', length: 255, nullable: false)]
    private string $email;

    #[Column(name: 'password', type: 'string', length: 255, nullable: false)]
    private string $password;

    #[Column(name: 'role', type: 'string', length: 255, nullable: false)]
    private string $role;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): User
    {
        $this->id = $id;
        return $this;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): User
    {
        $this->email = $email;
        return $this;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): User
    {
        $this->password = $password;
        return $this;
    }

    public function getRole(): string
    {
        return $this->role;
    }

    public function setRole(string $role): User
    {
        $this->role = $role;
        return $this;
    }
}