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
     * @return string
     */
    public function getFleetId(): string;

    /**
     * @param string $plateNumber
     * @return VehicleInterface|null
     */
    public function getVehicle(string $plateNumber): ?VehicleInterface;
}