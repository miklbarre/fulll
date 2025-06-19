<?php

namespace App\Entity;

use App\Interfaces\Entity\LocationInterface;
use App\Interfaces\Entity\VehicleInterface;
use Exception;

/**
 *
 */
class Vehicle implements VehicleInterface
{

    /**
     * @param string $plateNumber
     * @param LocationInterface|null $location
     */
    public function __construct(private string $plateNumber, private ?LocationInterface $location = null)
    {
    }

    /**
     * @return string
     */
    public function getPlateNumber(): string
    {
        return $this->plateNumber;
    }

    /**
     * @return LocationInterface|null
     */
    public function getLocation(): ?LocationInterface
    {
        return $this->location;
    }

    /**
     * @param LocationInterface $location
     * @return void
     * @throws Exception
     */
    public function parkAt(LocationInterface $location): void
    {
        if ($this->location && $this->location->equals($location)) {
            throw new Exception("Vehicle already parked");
        }
        $this->location = $location;
    }
}