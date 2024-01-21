<?php

namespace App\Models;

use App\Core\Model;

class User extends Model
{
    protected int $id;

    protected string $login;
    protected string $password_hash;
    protected int $admin;

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function isAdmin(): int
    {
        return $this->admin;
    }

    public function setAdmin(int $admin): void
    {
        $this->admin = $admin;
    }

    public function getLogin(): string
    {
        return $this->login;
    }

    public function setLogin(string $login): void
    {
        $this->login = $login;
    }

    public function getPasswordHash(): string
    {
        return $this->password_hash;
    }

    public function setPasswordHash(string $password_hash): void
    {
        $this->password_hash = $password_hash;
    }

}