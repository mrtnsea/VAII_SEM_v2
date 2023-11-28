<?php

namespace App\Models;

use App\Core\Model;

class Guide extends Model
{
    protected int $id;
    protected int $character_id;
    protected string $is_infographic;

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

    public function getIsInfographic(): string
    {
        return $this->is_infographic;
    }

    public function setIsInfographic(string $is_infographic): void
    {
        $this->is_infographic = $is_infographic;
    }
}