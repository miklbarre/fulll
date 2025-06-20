<?php

namespace App\Domain\Interfaces\Repository;

use App\Domain\Interfaces\Entity\VehicleInterface;

interface VehicleRepositoryInterface
{

    /**
     * @param VehicleInterface $vehicle
     * @return void
     */
    public function save(VehicleInterface $vehicle): void;

    /**
     * @param string $plateNumber
     * @param int $fleetId
     * @return VehicleInterface|null
     */
    public function findVehicle(string $plateNumber, int $fleetId): ?VehicleInterface;
}