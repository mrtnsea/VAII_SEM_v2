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
        if ($this->isLogged()) {
            $user = User::getAll("login = ?", [$_SESSION["user"]]);
            $a = sizeof($user);
            if (sizeof($user) === 1) {
                return $user[0]->getId();
            }
        }

        return null;
    }

    public function getLoggedUserContext(): mixed
    {
        return null;
    }

    public function isLogged(): bool
    {
        return isset($_SESSION["user"]) && $_SESSION["user"] != null;
    }

    public function isAdmin(): bool
    {
        $id = $this->getLoggedUserId();

        if ($id === null) {
            return false;
        }

        $user = User::getone($id);

        if ($user === null) {
            return false;
        }

        return $user->isAdmin();
    }
}