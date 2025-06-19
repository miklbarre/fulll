<?php

namespace App\Command;

use App\Interfaces\Entity\LocationInterface;

final class ParkVehicleCommand
{
    public function __construct(
        public string $plateNumber,
        public string $fleetId,
        public float  $latitude,
        public float  $longitude,
    )
    {
    }
}