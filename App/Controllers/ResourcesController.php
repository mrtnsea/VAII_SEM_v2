<?php

namespace App\Controllers;

use App\Core\AControllerBase;
use App\Core\HTTPException;
use App\Core\Responses\Response;
use App\Models\Guide;
use App\Models\User;

class ResourcesController extends AControllerBase
{

    public function authorize(string $action)
    {
        return $this->app->getAuth()->isAdmin();
    }

    public function index(): Response
    {
        $guides = Guide::getAll();
        $banners = [];
        $icons = [];
        $splash_arts = [];
        $relIcons = [];
        $pieces = [];


        foreach (scandir("public/images/characters/banners") as $banner) {
            if ($banner !== "." && $banner !== "..") {
                $banners[] = "public/images/characters/banners/" . $banner;
            }
        }

        foreach (scandir("public/images/characters/icons") as $icon) {
            if ($icon !== "." && $icon !== "..") {
                $icons[] = "public/images/characters/icons/" . $icon;
            }
        }

        foreach (scandir("public/images/characters/splash-arts") as $splash) {
            if ($splash !== "." && $splash !== "..") {
                $splash_arts[] = "public/images/characters/splash-arts/" . $splash;
            }
        }

        foreach (scandir("public/images/relics/icons") as $icon) {
            if ($icon !== "." && $icon !== "..") {
                $relIcons[] = "public/images/relics/icons/" . $icon;
            }
        }

        foreach (scandir("public/images/relics/pieces") as $piece) {
            if ($piece !== "." && $piece !== "..") {
                $pieces[] = "public/images/relics/icons/" . $piece;
            }
        }

        $data = [
            "guides" => $guides,
            "char-icons" => $icons,
            "banners" => $banners,
            "splash-arts" => $splash_arts,
            "relic-icons" => $relIcons,
            "pieces" => $pieces
        ];

        $error = "";

        if ($this->app->getRequest()->getValue("iconError") !== null) {
            $error .= $this->app->getRequest()->getValue("iconError");
        }

        if ($this->app->getRequest()->getValue("bannerError") !== null) {
            $error .= "\n" . $this->app->getRequest()->getValue("bannerError");
        }

        if ($this->app->getRequest()->getValue("resError") !== null) {
            $error .= "\n" . $this->app->getRequest()->getValue("resError");
        }

        if ($error !== "") {
            $data["error"] = $error;
        }

        if ($this->app->getRequest()->getValue("resFeedback") !== null) {
            $feedback = "\n" . $this->app->getRequest()->getValue("resFeedback");
            $data["feedback"] = $feedback;
        }

        return $this->html($data);
    }

    public function add() {
        $formData = $this->app->getRequest()->getPost();

        if (!isset($formData["submit"]) || !isset($formData["name"]) || !isset($formData["type"])) {
            throw new HTTPException("Bad Request!", 400);
        }

        if (!is_string($formData["type"]) || !is_string($formData["name"])) {
            throw new HTTPException("Bad Request!", 400);
        }

        if (strlen(trim($formData["name"])) === 0) {
            throw new HTTPException("Bad Request!", 400);
        }

        $types = [
            "Guide" => "Guide",
            "Banner" => "Banner",
            "Character Icon" => "Character Icon",
            "Splash-art" => "Splash-art",
            "Relic Icon" => "Relic Icon",
            "Relic piece" => "Relic piece"];

        if (!isset($types[$formData["type"]])) {
            throw new HTTPException("Bad Request!", 400);
        }

        if ($formData["type"] !== "Guide" && !isset($_FILES['fileInput'])) {
            throw new HTTPException("Bad Request!", 400);
        }

        $dir = "public/images/";
        switch ($formData["type"]) {
            case "Guide":
                $guide = new Guide();
                $guide->setName($formData["name"]);
                $guide->setVersion(1);
                $guide->setLastChange(date('Y-m-d H:i:s'));
                $banners = glob("public/images/characters/banners/" . $formData["name"] . "*");
                $icons = glob("public/images/characters/icons/" . $formData["name"] . "*");

                if (empty($banners) || empty($icons)) {
                    $iconError = empty($icons) ? "Character Icon with this name is missing!" : "";
                    $bannerError = empty($banners) ? "Character Banner with this name is missing!" : "";
                    return $this->redirect($this->url("index", ["iconError" =>$iconError, "bannerError" => $bannerError]));
                }

                $guide->setBannerImage($banners[0]);
                $guide->setIcon($icons[0]);
                $guide->setInfographicImage(null);
                $guide->save();
                return $this->redirect($this->url("index", ["resFeedback" => "Upload successful!"]));

            case "Banner":
                $dir .= "characters/banners/";
                break;
            case "Character Icon":
                $dir .= "characters/icons/";
                break;
            case "Splash-art":
                $dir .= "characters/splash-arts/";
                break;
            case "Relic Icon":
                $dir .= "relics/icons/";
                break;
            case "Relic piece":
                $dir .= "relics/pieces/";
                break;
        }

        $files = glob($dir . $formData["name"] . "*");

        if (!empty($files)) {
            $error = $formData["type"] . " with the name " . $formData["name"] . " already exists!";
            return $this->redirect($this->url("index", ["resError" => $error]));
        }

        if (!isset($_FILES['fileInput']) || $_FILES['fileInput']['error'] !== UPLOAD_ERR_OK) {
            $error = "Failed to upload!";
            return $this->redirect($this->url("index", ["resError" => $error]));
        }

        $tempFile = $_FILES['fileInput']['tmp_name'];
        $fileType = $_FILES['fileInput']['type'];
        $extension = "";

        switch ($fileType) {
            case "image/jpeg":
                $extension .= ".jpg";
                break;
            case "image/webp":
                $extension .= ".webp";
                break;
            case "image/png":
                $extension .= ".png";
                break;
            default:
                throw new HTTPException("Bad Request!", 400);
        }

        move_uploaded_file($tempFile, $dir . $formData["name"] . $extension);
        return $this->redirect($this->url("index", ["resFeedback" => "Upload successful!"]));
    }
}