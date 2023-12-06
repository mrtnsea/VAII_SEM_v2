<?php

namespace App\Models;

use App\Core\Model;

class Section extends Model
{
    protected int $id;
    protected int $guide_id;
    protected ?int $parent_section;
    protected int $order;
    protected string $header;
    protected string $name;
    protected ?string $text;

    /**
     * @param int $guide_id
     * @param int|null $parent_section
     * @param int $order
     * @param string $header
     * @param string $name
     * @param string|null $text
     */

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getGuideId(): int
    {
        return $this->guide_id;
    }

    public function setGuideId(int $guide_id): void
    {
        $this->guide_id = $guide_id;
    }

    public function getParentSection(): ?int
    {
        return $this->parent_section;
    }

    public function setParentSection(?int $parent_section): void
    {
        $this->parent_section = $parent_section;
    }

    public function getOrder(): int
    {
        return $this->order;
    }

    public function setOrder(int $order): void
    {
        $this->order = $order;
    }

    public function getHeader(): string
    {
        return $this->header;
    }

    public function setHeader(string $header): void
    {
        $this->header = $header;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getText(): ?string
    {
        return $this->text;
    }

    public function setText(?string $text): void
    {
        $this->text = $text;
    }
}