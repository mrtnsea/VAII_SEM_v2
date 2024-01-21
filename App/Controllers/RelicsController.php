<?php

namespace App\Controllers;

use App\Core\AControllerBase;
use App\Core\Responses\Response;
use App\Models\Relic;

class RelicsController extends AControllerBase
{
    public function authorize(string $action)
    {
        return $this->app->getAuth()->isLogged();
    }

    public function index(): Response
    {
        $relics = Relic::getAll("userId = ?", [$this->app->getAuth()->getLoggedUserId()]);
        $pieces = [];

        foreach (scandir("public/images/relics/pieces") as $piece) {
            if ($piece !== "." && $piece !== "..") {
                $pieces[] = $piece;
            }
        }

        return $this->html(["relics" =>$relics, "pieces" => $pieces]);
    }
}