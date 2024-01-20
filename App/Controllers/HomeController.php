<?php

namespace App\Controllers;

use App\Core\AControllerBase;
use App\Core\Responses\Response;
use App\Models\Character;
use App\Models\Guide;

/**
 * Class HomeController
 * Example class of a controller
 * @package App\Controllers
 */
class HomeController extends AControllerBase
{
    /**
     * Authorize controller actions
     * @param $action
     * @return bool
     */
    public function authorize($action)
    {
        return true;
    }

    /**
     * Example of an action (authorization needed)
     * @return \App\Core\Responses\Response|\App\Core\Responses\ViewResponse
     */
    public function index(): Response
    {
        $guides = Guide::getAll();
        $names = [];

        foreach ($guides as $guide) {
            if (!isset($names[$guide->getName()])) {
                $names[$guide->getName()] = $guide->getName();
            }
        }

        return $this->html(["guides" => $guides, "names" => $names]);
    }
}
