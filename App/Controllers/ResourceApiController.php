<?php

namespace App\Controllers;

use App\Core\AControllerBase;
use App\Core\HTTPException;
use App\Core\Responses\Response;
use App\Models\Guide;
use App\Models\User;

class ResourceApiController extends AControllerBase
{
    public function authorize(string $action)
    {
        return $this->app->getAuth()->isAdmin();
    }

    public function index(): Response
    {
        throw new HTTPException(501, "Not Implemented");
    }

    public function removeResource() : Response
    {
        $json = $this->app->getRequest()->getRawBodyJSON();

        if (!is_object($json) || !property_exists($json, "type")) {
            throw new HTTPException(400, "Bad Request");
        }

        if ($json->type === "guide") {
            if (!property_exists($json, "id")) {
                throw new HTTPException(400, "Bad Request");
            }

            $guide = Guide::getOne($json->id);

            if ($guide === null) {
                return $this->json(false);
            }

            $guide->delete();
            return $this->json(true);
        }

        if (!property_exists($json, "path")) {
            throw new HTTPException(400, "Bad Request");
        }

        if (strpos($json->path, "public/images/") === 0) {
            if (unlink($json->path)) {
                $obj = (object) [
                    "success" => true,
                    "property2" => $json->type
                ];

                return $this->json($obj);
            }
        }

        $obj = (object) [
            "success" => false,
            "property2" => $json->type
        ];

        return $this->json($obj);
    }
}