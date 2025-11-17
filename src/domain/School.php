<?php
namespace domain;

require_once __DIR__ . '/Degree.php';
use Domain\Degree;


class School
{
    public int $id;
    public string $name;
    public string $county;
    public string $city;
    public int $studentCount;

    /** @var Degree[] */
    private array $degrees;

    public function __construct(int $id, string $name, string $county, string $city, int $studentCount, array $degrees = [])
    {
        $this->id = $id;
        $this->name = $name;
        $this->county = $county;
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
}