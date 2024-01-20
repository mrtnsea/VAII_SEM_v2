<?php

namespace App\Controllers;

use App\Core\AControllerBase;
use App\Core\HTTPException;
use App\Core\Responses\EmptyResponse;
use App\Core\Responses\Response;
use App\Models\Image;

class GuideApiController extends AControllerBase
{
    public function index(): Response
    {
        throw new HTTPException(501, "Not Implemented");
    }

    public function removeImage(): Response
    {
        $json = $this->app->getRequest()->getRawBodyJSON();

        if (!is_object($json) || !property_exists($json, "id")) {
            throw new HTTPException(400, "Bad Request");
        }

        if (!is_int($json->id) || $json->id < 1) {
            throw new HTTPException(400, "Bad Request");
        }

        Image::getOne($json->id)->delete();
        return new EmptyResponse();
    }

    public function addImage(): Response
    {
        $json = $this->app->getRequest()->getRawBodyJSON();

        if (!is_object($json) || !property_exists($json, "id")
            || !property_exists($json, "path") || !property_exists($json, "header")) {
            throw new HTTPException(400, "Bad Request");
        }

        if (!is_int($json->id) || $json->id < 1) {
            throw new HTTPException(400, "Bad Request");
        }

        if (!str_starts_with($json->path, "public/images")) {
            throw new HTTPException(400, "Bad Request");
        }

        $image = new Image();
        $image->setImage($json->path);
        $image->setCardHeader($json->header);
        $image->setSectionId($json->id);
        $image->save();

        return new EmptyResponse();
    }
}