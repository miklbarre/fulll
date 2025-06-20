<?php

namespace App\Interfaces\Entity;

/**
 *
 */
interface FleetInterface
{
    /**
     * @param VehicleInterface $vehicle
     * @return bool
     */
    public function hasVehicle(VehicleInterface $vehicle): bool;

    /**
     * @param VehicleInterface $vehicle
     * @return void
     */
    public function addVehicle(VehicleInterface $vehicle): void;

    /**
     * @return int
     */
    public function getFleetId(): int;
}