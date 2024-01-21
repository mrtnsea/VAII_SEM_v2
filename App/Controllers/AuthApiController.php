<?php

namespace App\Controllers;

use App\Core\AControllerBase;
use App\Core\HTTPException;
use App\Core\Responses\Response;
use App\Models\User;
use stdClass;

class AuthApiController extends AControllerBase
{
    public function index(): Response
    {
        throw new HTTPException(501, "Not Implemented");
    }

    public function login(): Response
    {
        $json = $this->app->getRequest()->getRawBodyJSON();
        if (!is_object($json) || !property_exists($json, "login") || !property_exists($json, "password")) {
            throw new HTTPException(400, "Bad Request!");
        }

        if (!is_string($json->login) || !is_string($json->password)) {
            throw new HTTPException(400, "Bad Request!");
        }

        if (preg_match("/\s/", $json->login)) {
            throw new HTTPException(400, "Bad Request!");
        }

        if (preg_match("/\s/", $json->password)) {
            throw new HTTPException(400, "Bad Request!");
        }

        $logged = $this->app->getAuth()->login($json->login, $json->password);
        if ($logged) {
            return $this->json(true);
        } else {
            return $this->json(false);
        }
    }

    public function register(): Response
    {
        $json = $this->app->getRequest()->getRawBodyJSON();

        if (!is_object($json) || !property_exists($json, "login") || !property_exists($json, "password")) {
            throw new HTTPException(400, "Bad Request!");
        }

        if (!is_string($json->login) || !is_string($json->password)) {
            throw new HTTPException(400, "Bad Request!");
        }

        if (preg_match("/\s/", $json->login)|| strlen($json->login) === 0) {
            throw new HTTPException(400, "Bad Request!");
        }

        if (!preg_match("/\d/", $json->password) || !preg_match("/[^0-9]/", $json->password)) {
            throw new HTTPException(400, "Bad Request!");
        }

        if (preg_match("/\s/", $json->password) || strlen($json->password) < 8) {
            throw new HTTPException(400, "Bad Request!");
        }

        if (sizeof(User::getAll("login = ?", [$json->login])) == 0) {
            $user = new User();
            $user->setLogin($json->login);
            $hash = password_hash($json->password, PASSWORD_DEFAULT);
            $user->setPasswordHash($hash);
            $user->setAdmin(0);
            $user->save();
            $obj = new stdClass();
            $obj->success = true;
            $obj->message = "Registration successful!";
            return $this->json($obj);
        } else {
            $obj = new stdClass();
            $obj->success = false;
            $obj->message = "Login is already taken!";
            return $this->json($obj);
        }
    }
}