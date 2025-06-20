<?php

namespace App\Repository;

use App\Entity\Vehicle;
use App\Interfaces\Entity\VehicleInterface;
use App\Interfaces\Repository\VehicleRepositoryInterface;

final class VehicleRepository extends EntityRepository implements VehicleRepositoryInterface
{
    protected static string $className = Vehicle::class;

    /**
     * @param VehicleInterface $vehicle
     * @return void
     */
    public function save(VehicleInterface $vehicle): void
    {
        $this->persistAndFlush($vehicle);
    }

    /**
     * @param string $plateNumber
     * @param int $fleetId
     * @return VehicleInterface|null
     */
    public function findVehicle(string $plateNumber, int $fleetId): ?VehicleInterface
    {
        return $this->repository->findOneBy(['plateNumber' => $plateNumber, 'fleet' => $fleetId]);
    }
}
