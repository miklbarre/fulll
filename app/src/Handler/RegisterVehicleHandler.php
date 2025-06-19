<?php

namespace App\Handler;

use App\Command\RegisterVehicleCommand;
use App\Entity\Vehicle;
use App\Interfaces\Handler\RegisterVehicleHandlerInterface;
use App\Interfaces\Repository\FleetRepositoryInterface;
use Exception;

final class RegisterVehicleHandler implements RegisterVehicleHandlerInterface
{
    /**
     * @param FleetRepositoryInterface $repository
     */
    public function __construct(private FleetRepositoryInterface $repository)
    {
    }

    /**
     * @param RegisterVehicleCommand $command
     * @return void
     * @throws Exception
     */
    public function __invoke(RegisterVehicleCommand $command): void
    {
        $fleet = $this->repository->find($command->fleetId);

        if (!$fleet) {
            throw new Exception('Fleet not found');
        }

        $vehicle = new Vehicle($command->plateNumber);
        $fleet->addVehicle($vehicle);
        $this->repository->save($fleet);
    }
}