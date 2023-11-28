<?php

namespace App\Models;

use App\Core\Model;

class Image extends Model
{
    protected int $id;
    protected int $section_id;
    protected string $image;
    protected string $card_header;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getSectionId(): int
    {
        return $this->section_id;
    }

    public function setSectionId(int $section_id): void
    {
        $this->section_id = $section_id;
    }

    public function getImage(): string
    {
        return $this->image;
    }

    public function setImage(string $image): void
    {
        $this->image = $image;
    }

    public function getCardHeader(): string
    {
        return $this->card_header;
    }

    public function setCardHeader(string $card_header): void
    {
        $this->card_header = $card_header;
    }
}