<?php

namespace domain;

use mysqli;

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

    public function toString(): string
    {
        return "{$this->cityName}, {$this->countryName}";
    }

    public static function getAllCountries(mysqli $mysqli): array
    {
        $sql = "SELECT id, name FROM countries ORDER BY name";
        $statement = $mysqli->prepare($sql);
        $statement->execute();
        $result = $statement->get_result();
        $countries = [];
        while ($row = $result->fetch_assoc()) {
            $countries[] = $row;
        }
        return $countries;
    }

    public static function getAllCities(mysqli $mysqli): array
    {
        $sql = "SELECT id, name FROM cities ORDER BY name";
        $statement = $mysqli->prepare($sql);
        $statement->execute();
        $result = $statement->get_result();
        $cities = [];
        while ($row = $result->fetch_assoc()) {
            $cities[] = $row;
        }
        return $cities;
    }

    public static function getCitiesInCountry(mysqli $mysqli, int $countryId): array
    {
        $sql = "SELECT id, name as name 
                FROM cities
                WHERE country_id = ?
                ORDER BY name";
        $statement = $mysqli->prepare($sql);
        $statement->bind_param("i", $countryId);
        $statement->execute();
        $result = $statement->get_result();
        $cities = [];
        while ($row = $result->fetch_assoc()) {
            $cities[] = $row;
        }
        return $cities;
    }
}