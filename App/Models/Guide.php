<?php

namespace App\Models;

use App\Core\Model;

class Guide extends Model
{
    protected int $id;
    protected int $version;
    protected string $last_change;
    protected int $character_id;
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

    public function getCharacterId(): int
    {
        return $this->character_id;
    }

    public function setCharacterId(int $character_id): void
    {
        $this->character_id = $character_id;
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