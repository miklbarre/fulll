<?php

namespace App\Handler;

use App\Command\ParkVehicleCommand;
use App\Entity\Location;
use App\Interfaces\Handler\ParkVehicleHandleInterface;
use App\Interfaces\Repository\FleetRepositoryInterface;
use Exception;

final class ParkVehicleHandler implements ParkVehicleHandleInterface
{
    public function __construct(private FleetRepositoryInterface $fleetRepository)
    {
    }

    /**
     * @throws Exception
     */
    public function __invoke(ParkVehicleCommand $command): void
    {
        $fleet = $this->fleetRepository->find($command->fleetId);
        $vehicle = $fleet->getVehicle($command->plateNumber);

        if(!$vehicle) {
            throw new Exception('Vehicle not found');
        }

        $location = new Location($command->latitude, $command->longitude);
        $vehicle->parkAt($location);

        $this->fleetRepository->save($fleet);
    }

}