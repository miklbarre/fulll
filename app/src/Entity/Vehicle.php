<?php

namespace App\Entity;

use App\Interfaces\Entity\VehicleInterface;

/**
 *
 */
class Vehicle implements VehicleInterface
{

    /**
     * @param string $plateNumber
     */
    public function __construct(private string $plateNumber)
    {
    }

    /**
     * @return string
     */
    public function getPlateNumber(): string
    {
        return $this->plateNumber;
    }

}