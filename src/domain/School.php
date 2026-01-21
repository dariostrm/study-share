<?php
namespace domain;

class School
{
    public int $id;
    public string $name;
    public Location $location;
    public int $studentCount;
    public ?string $logoPath = null;

    /** @var Degree[] */
    private array $degrees;

    public function __construct(int $id, string $name, Location $location, int $studentCount, array $degrees = [])
    {
        $this->id = $id;
        $this->name = $name;
        $this->location = $location;
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

    public function getDegreeById(int $degreeId): ?Degree
    {
        foreach ($this->degrees as $degree) {
            if ($degree->id === $degreeId) {
                return $degree;
            }
        }
        return null;
    }

    public function getDegreeByName(string $degreeName): ?Degree
    {
        foreach ($this->degrees as $degree) {
            if ($degree->name === $degreeName) {
                return $degree;
            }
        }
        return null;
    }
}