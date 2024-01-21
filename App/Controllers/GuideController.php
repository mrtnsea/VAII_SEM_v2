<?php

namespace App\Controllers;

use App\Core\AControllerBase;
use App\Core\HTTPException;
use App\Core\Responses\Response;
use App\Models\Guide;
use App\Models\Image;
use App\Models\Section;

class GuideController extends AControllerBase
{
    public function authorize($action)
    {
        if ($action === "index") {
            return true;
        }

        return $this->app->getAuth()->isAdmin();
    }

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

    public function edit(): Response
    {
        $id = $this->request()->getValue("id");
        $sections = array();
        $images = array();

        if ($id != null) {
            $sections = Section::getAll("guide_id = ?", [$id]);
            foreach ($sections as $section) {
                $section_id = $section->getID();
                $images_with_id = Image::getAll("section_id = ?", [$section_id]);
                $images += array_merge($images, $images_with_id);
            }
        }

        $resources = glob("public/images/characters/splash-arts/*.*");
        $resources = array_merge($resources, glob("public/images/characters/icons/*.*"));
        $resources = array_merge($resources, glob("public/images/characters/icons/*.*"));
        $resources = array_merge($resources, glob("public/images/relics/icons/*.*"));
        $resources = array_merge($resources, glob("public/images/relics/stats/*.*"));

        return $this->html([
            "id" => $id,
            "sections" => $sections,
            "images" => $images,
            "resources" => $resources
        ]);
    }

    public function save(): Response
    {
        $id = $this->request()->getValue("id");
        if (!is_numeric($id)) {
            return $this->redirect($this->url("home.index", ["id" => $id]));
        }
        $post = $this->request()->getPost();

        $keys = array_keys($post);
        $section_ids = preg_grep("/s_id_\d+$/", $keys);

        foreach ($section_ids as $section_id) {
            $section_id = str_replace("s_id_", "", $section_id);
            if (is_numeric($section_id)) {
                $section = Section::getOne($section_id);
                if ($section !== null) {
                    $text = $post["text_$section_id"];
                    $header = $post["s_header_$section_id"];
                    $section->setText($text == null ? null : $text);
                    $section->setHeader($header);
                    $section->setName($header);
                    $section->save();
                }
            }
        }

        return $this->redirect($this->url("guide.index", ["id" => $id]));
    }

    public function delete(): Response
    {
        $id = $this->request()->getValue("id");

        if (is_numeric($id)) {
            $sections = Section::getAll("guide_id = ?", [$id]);

            foreach ($sections as $section) {
                $section_id = $section->getID();
                $images = Image::getAll("section_id = $section_id");
                foreach ($images as $image) {
                    $image->delete();
                }
                $section->delete();
            }

            Guide::getOne($id)->delete();
        }

        return $this->redirect($this->url("home.index"));
    }

    public function add(): Response
    {
        $id = intval($this->request()->getValue("id"));

        $sections = Section::getAll("guide_id = ?", [$id]);
        $order = 1;

        foreach ($sections as $section) {
            if ($order <= $section->getOrder()) {
                $order = $section->getOrder() + 1;
            }
        }

        $section = new Section();
        $section->setName("");
        $section->setParentSection(null);
        $section->setText(null);
        $section->setOrder($order);
        $section->setHeader("");
        $section->setGuideId($id);
        $section->save();
        return $this->redirect($this->url("edit", ["id" => $id]));
    }
}