<?php

namespace App\Auth;

use App\Core\IAuthenticator;
use App\Models\User;

class MyAuthenticator implements IAuthenticator
{
    public function __construct()
    {
        session_start();
    }
    public function login($login, $password): bool
    {
        $user = User::getAll("login = ?", [$login]);

        if (sizeof($user) != 1) {
            return false;
        }

        if (password_verify($password, $user[0]->getPasswordHash())) {
            $_SESSION["user"] = $login;
            return true;
        }

        return false;
    }

    public function logout(): void
    {
        if (isset($_SESSION["user"])) {
            unset($_SESSION["user"]);
            session_destroy();
        }
    }

    public function getLoggedUserName(): string
    {
        return isset($_SESSION["user"]) ? $_SESSION["user"] : throw new \Exception("User not logged in");
    }

    public function getLoggedUserId(): mixed
    {
        return $_SESSION["user"];
    }

    public function getLoggedUserContext(): mixed
    {
        return null;
    }

    public function isLogged(): bool
    {
        return isset($_SESSION["user"]) && $_SESSION["user"] != null;
    }
}