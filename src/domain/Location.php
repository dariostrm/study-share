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

    public static function construct(array $data): Location
    {
        return new Location(
            (int)$data['city_id'],
            $data['city_name'],
            (int)$data['country_id'],
            $data['country_name']
        );
    }

    public function toString(): string {
        return "{$this->cityName}, {$this->countryName}";
    }
}