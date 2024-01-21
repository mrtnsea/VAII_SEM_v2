<?php

namespace App\Controllers;

use App\Core\AControllerBase;
use App\Core\HTTPException;
use App\Core\Responses\EmptyResponse;
use App\Core\Responses\Response;
use App\Models\Relic;

class RelicsApiController extends AControllerBase
{

    public function index(): Response
    {
        throw new HTTPException(501, "Not implemented!");
    }

    public function removeRelic() {
        $json = $this->app->getRequest()->getRawBodyJSON();

        if (!is_object($json) || !property_exists($json, "id")) {
            throw new HTTPException(400, "Bad Request!");
        }

        if (!is_int($json->id)) {
            throw new HTTPException(400, "Bad Request!");
        }

        $relic = Relic::getOne($json->id);

        if ($relic->getUserId() !== $this->app->getAuth()->getLoggedUserId()) {
            throw new HTTPException(401, "Unauthorized!");
        }

        $relic->delete();
        return new EmptyResponse();
    }

    public function addRelic() {
        $json = $this->app->getRequest()->getRawBodyJSON();

        if (!is_object($json)) {
            throw new HTTPException(400, "Bad Request!");
        }

        if (!property_exists($json, "path") || !is_string($json->path)) {
            throw new HTTPException(400, "Bad Request!");
        }

        if (!file_exists("public/images/relics/pieces/" . $json->path)) {
            throw new HTTPException(400, "Bad Request!");
        }

        $relic = new Relic();
        $relic->setUserId($this->app->getAuth()->getLoggedUserId());
        $relic->setIcon("public/images/relics/pieces/" . $json->path);

        if (!property_exists($json, "main") || !property_exists($json, "mainVal")
            || !property_exists($json, "first") || !property_exists($json, "firstVal")
            || !property_exists($json, "second") || !property_exists($json, "secondVal")
            || !property_exists($json, "third") || !property_exists($json, "thirdVal")) {
            throw new HTTPException(400, "Bad Request!");
        }

        $types = [
            "Atk%" => "Atk%",
            "Hp%" => "Hp%",
            "Dmg%" => "Dmg%",
            "Speed" => "Speed",
            "Crit Rate" => "Crit Rate",
            "Crit Damage" => "Crit Damge"
        ];

        if ($types[$json->main] === null || $types[$json->first] === null
            || $types[$json->second] === null || $types[$json->third] === null) {
            throw new HTTPException(400, "Bad Request!");
        }

        if ($json->mainVal < 0 || $json->mainVal > 64 || $json->firstVal < 0 || $json->firstVal > 25
            || $json->secondVal < 0 || $json->secondVal > 25 || $json->thirdVal < 0 || $json->thirdVal > 25) {
            throw new HTTPException(400, "Bad Request!");
        }

        $relic->setMain($json->main);
        $relic->setFirst($json->first);
        $relic->setSecond($json->second);
        $relic->setThird($json->third);
        $relic->setMainVal($json->mainVal);
        $relic->setFirstVal($json->firstVal);
        $relic->setSecondVal($json->secondVal);
        $relic->setThirdVal($json->thirdVal);
        $relic->save();

        return new EmptyResponse();
    }
}