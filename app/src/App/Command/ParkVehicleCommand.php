<?php

namespace App\App\Command;

final class ParkVehicleCommand
{
    public function __construct(
        public readonly string $plateNumber,
        public readonly string $fleetId,
        public readonly float  $latitude,
        public readonly float  $longitude,
    )
    {
    }
}