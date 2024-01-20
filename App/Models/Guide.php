<?php

namespace App\Models;

use App\Core\Model;

class Guide extends Model
{
    protected int $id;
    protected int $version;
    protected string $last_change;
    protected string $name;
    protected string $icon;
    protected string $banner_image;

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getIcon(): string
    {
        return $this->icon;
    }

    public function setIcon(string $icon): void
    {
        $this->icon = $icon;
    }

    public function getBannerImage(): string
    {
        return $this->banner_image;
    }

    public function setBannerImage(string $banner_image): void
    {
        $this->banner_image = $banner_image;
    }
    protected ?string $infographic_image;

    public function getVersion(): int
    {
        return $this->version;
    }

    public function setVersion(int $version): void
    {
        $this->version = $version;
    }

    public function getLastChange(): string
    {
        return $this->last_change;
    }

    public function setLastChange(string $last_change): void
    {
        $this->last_change = $last_change;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getInfographicImage(): ?string
    {
        return $this->infographic_image;
    }

    public function setInfographicImage(?string $infographic_image): void
    {
        $this->infographic_image = $infographic_image;
    }
}