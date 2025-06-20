<?php

namespace App\Handler;

use App\Command\ParkVehicleCommand;
use App\Entity\Location;
use App\Interfaces\Handler\ParkVehicleHandleInterface;
use App\Interfaces\Repository\VehicleRepositoryInterface;
use Exception;

final class ParkVehicleHandler implements ParkVehicleHandleInterface
{
    public function __construct(private VehicleRepositoryInterface $vehicleRepository)
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