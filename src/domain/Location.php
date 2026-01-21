<?php

namespace domain;

class Location
{
    public int $cityId;
    public string $cityName;

    public int $countryId;
    public string $countryName;

    public function __construct(int $cityId, string $cityName, int $countryId, string $countryName)
    {
        $this->cityId = $cityId;
        $this->cityName = $cityName;
        $this->countryId = $countryId;
        $this->countryName = $countryName;
    }

    public function toString(): string {
        return "{$this->cityName}, {$this->countryName}";
    }
}