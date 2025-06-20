<?php

namespace App\App\Handler;

use App\App\Command\RegisterVehicleCommand;
use App\Domain\Entity\Vehicle;
use App\Domain\Interfaces\Handler\RegisterVehicleHandlerInterface;
use App\Domain\Interfaces\Repository\FleetRepositoryInterface;
use Exception;

final class RegisterVehicleHandler implements RegisterVehicleHandlerInterface
{
    /**
     * @param FleetRepositoryInterface $repository
     */
    public function __construct(private readonly FleetRepositoryInterface $repository)
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

        $vehicle = new Vehicle($command->plateNumber, $fleet);

        $fleet->addVehicle($vehicle);
        $this->repository->save($fleet);
    }
}