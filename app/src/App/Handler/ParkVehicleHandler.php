<?php

namespace App\App\Handler;

use App\App\Command\ParkVehicleCommand;
use App\Domain\Entity\Location;
use App\Domain\Interfaces\Handler\ParkVehicleHandleInterface;
use App\Domain\Interfaces\Repository\VehicleRepositoryInterface;
use Exception;

final class ParkVehicleHandler implements ParkVehicleHandleInterface
{
    public function __construct(private readonly VehicleRepositoryInterface $vehicleRepository)
    {
    }

    /**
     * @throws Exception
     */
    public function __invoke(ParkVehicleCommand $command): void
    {
        if (!$vehicle = $this->vehicleRepository->findVehicle($command->plateNumber, $command->fleetId)) {
            throw new Exception('Vehicle not found');
        }

        $location = new Location($command->latitude, $command->longitude);
        $vehicle->parkAt($location);

        $this->vehicleRepository->save($vehicle);
    }

}