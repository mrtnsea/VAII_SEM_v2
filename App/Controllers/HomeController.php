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
        $banners = array();
        $names = array();
        $icons = array();

        foreach ($guides as $guide) {
            $character = Character::getOne($guide->getCharacterId());
            $name = $character->getName();
            $banners[] = $character->getBannerImage();
            $icons[] = $character->getIconImage();
            $names[] = $name;
        }

        return $this->html([
            "guides" => $guides,
            "banners" => $banners,
            "icons" => $icons,
            "names" => $names
            ]);
    }
}
