<?php

namespace App\Models;

use App\Core\Model;

class Relic extends Model
{
    protected int $id;
    protected int $userId;

    protected string $icon;
    protected string $main;
    protected string $first;
    protected string $second;
    protected string $third;
    protected int $mainVal;
    protected int $firstVal;
    protected int $secondVal;
    protected int $thirdVal;

    public function getUserId(): int
    {
        return $this->userId;
    }

    public function setUserId(int $userId): void
    {
        $this->userId = $userId;
    }

    public function getIcon(): string
    {
        return $this->icon;
    }

    public function setIcon(string $icon): void
    {
        $this->icon = $icon;
    }

    public function getMain(): string
    {
        return $this->main;
    }

    public function setMain(string $main): void
    {
        $this->main = $main;
    }

    public function getFirst(): string
    {
        return $this->first;
    }

    public function setFirst(string $first): void
    {
        $this->first = $first;
    }

    public function getSecond(): string
    {
        return $this->second;
    }

    public function setSecond(string $second): void
    {
        $this->second = $second;
    }

    public function getThird(): string
    {
        return $this->third;
    }

    public function setThird(string $third): void
    {
        $this->third = $third;
    }

    public function getMainVal(): int
    {
        return $this->mainVal;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setMainVal(float $mainVal): void
    {
        $this->mainVal = $mainVal;
    }

    public function getFirstVal(): int
    {
        return $this->firstVal;
    }

    public function setFirstVal(float $firstVal): void
    {
        $this->firstVal = $firstVal;
    }

    public function getSecondVal(): int
    {
        return $this->secondVal;
    }

    public function setSecondVal(float $secondVal): void
    {
        $this->secondVal = $secondVal;
    }

    public function getThirdVal(): int
    {
        return $this->thirdVal;
    }

    public function setThirdVal(float $thirdVal): void
    {
        $this->thirdVal = $thirdVal;
    }
}