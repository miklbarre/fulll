<?php

namespace App\Command;

final class RegisterVehicleCommand
{
    /**
     * @param string $fleetId
     * @param string $plateNumber
     */
    public function __construct(
        public readonly string $fleetId,
        public readonly string $plateNumber
    )
    {
    }
}
