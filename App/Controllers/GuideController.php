<?php

namespace App\Controllers;

use App\Core\AControllerBase;
use App\Core\Responses\Response;
use App\Models\Image;
use App\Models\Section;

class GuideController extends AControllerBase
{
    public function index(): Response
    {
        $id = $this->request()->getValue("id");
        $sections = Section::getAll("guide_id = $id");
        $images = array();
        foreach ($sections as $section) {
            $section_id = $section->getID();
            $images_with_id = Image::getAll("section_id = $section_id");
            $images += array_merge($images, $images_with_id);
        }

        return $this->html([
            "id" => $id,
            "sections" => $sections,
            "images" => $images
        ]);
    }
}