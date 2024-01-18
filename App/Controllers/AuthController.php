<?php

namespace App\Controllers;

use App\Config\Configuration;
use App\Core\AControllerBase;
use App\Core\Responses\Response;
use App\Core\Responses\ViewResponse;
use App\Models\User;

/**
 * Class AuthController
 * Controller for authentication actions
 * @package App\Controllers
 */
class AuthController extends AControllerBase
{
    /**
     *
     * @return Response
     */
    public function index(): Response
    {
        return $this->redirect(Configuration::LOGIN_URL);
    }

    /**
     * Login a user
     * @return Response
     */
    public function login(): Response
    {
        $formData = $this->app->getRequest()->getPost();
        $logged = null;

        if (isset($formData["submit"])) {
            if (!is_string($formData["login"]) || !is_string($formData["password"])) {
                return $this->html();
            }

            if (preg_match("/\s/", $formData["login"])) {
                return $this->html();
            }

            if (preg_match("/\s/", $formData["password"])) {
                return $this->html();
            }

            $logged = $this->app->getAuth()->login($formData["login"], $formData["password"]);
            if ($logged) {
                return $this->redirect($this->url("home.index"));
            } else {
                $data = [];
                $data["passwordError"] = "Login information are not valid!";
                $data["password"] = $formData["password"];
                $data["login"] = $formData["login"];
                return $this->html($data);
            }
        }

        return $this->html();
    }

    /**
     * Logout a user
     * @return ViewResponse
     */
    public function logout(): Response
    {
        $this->app->getAuth()->logout();
        return $this->redirect($this->url("home.index"));
    }

    public function register(): Response
    {
        $formData = $this->app->getRequest()->getPost();
        $data = [];

        if (isset($formData["submit"])) {
            if (!is_string($formData["login"]) || !is_string($formData["password"])) {
                return $this->html();
            }

            if (preg_match("/\s/", $formData["login"])
                || strlen($formData["login"]) === 0) {
                return $this->html();
            }

            if (!preg_match("/\d/", $formData["password"]) || !preg_match("/[^0-9]/", $formData["password"])) {
                return $this->html();
            }

            if (preg_match("/\s/", $formData["password"])
                || strlen($formData["password"]) < 8) {
                return $this->html();
            }

            if (sizeof(User::getAll("login = ?", [$formData["login"]])) == 0) {
                $user = new User();
                $user->setLogin($formData["login"]);
                $hash = password_hash($formData["password"], PASSWORD_DEFAULT);
                $user->setPasswordHash($hash);
                $user->save();
            } else {
                $data["login"] = $formData["login"];
                $data["password"] = $formData["password"];
                $data["passwordRep"] = $formData["passwordRep"];
                $data["loginError"] = "Login is already taken!";
            }
        }

        return $this->html($data);
    }
}
