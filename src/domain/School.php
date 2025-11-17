<?php
namespace Domain;
use Domain\Degree;


class School
{
    public int $id;
    public string $name;
    public string $country;
    public string $city;
    public int $studentCount;
    public ?string $logoPath = null;

    /** @var Degree[] */
    private array $degrees;

    public function __construct(int $id, string $name, string $country, string $city, int $studentCount, array $degrees = [])
    {
        $this->id = $id;
        $this->name = $name;
        $this->country = $country;
        $this->city = $city;
        $this->studentCount = $studentCount;
        $this->degrees = $degrees;
    }

    /**
     * @return Degree[]
     */
    public function getDegrees(): array
    {
        return $this->degrees;
    }
    public function addDegree(Degree $degree): void
    {
        array_push($this->degrees, $degree);
    }
    
    public function removeDegree(int $degreeId): void
    {
        $this->degrees = array_filter($this->degrees, fn($degree) => $degree->id !== $degreeId);
    }
}