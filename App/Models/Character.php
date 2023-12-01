<?php

namespace App\Models;

use App\Core\Model;

class Character extends Model
{
    protected int $id;
    protected string $name;
    protected string $icon_image;
    protected string $banner_image;
    protected string $splash_image;

    public function getIconImage(): string
    {
        return $this->icon_image;
    }

    public function setIconImage(string $icon_image): void
    {
        $this->icon_image = $icon_image;
    }

    public function getBannerImage(): string
    {
        return $this->banner_image;
    }

    public function setBannerImage(string $banner_image): void
    {
        $this->banner_image = $banner_image;
    }

    public function getSplashImage(): string
    {
        return $this->splash_image;
    }

    public function setSplashImage(string $splash_image): void
    {
        $this->splash_image = $splash_image;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }
}