<?php

namespace App\Infra\Repository;

use App\Domain\Entity\Vehicle;
use App\Domain\Interfaces\Entity\VehicleInterface;
use App\Domain\Interfaces\Repository\VehicleRepositoryInterface;

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
