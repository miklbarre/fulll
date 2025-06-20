<?php

namespace App\App\Handler;

use App\App\Command\RegisterFleetCommand;
use App\Domain\Entity\Fleet;
use App\Domain\Interfaces\Entity\FleetInterface;
use App\Domain\Interfaces\Handler\RegisterFleetHandlerInterface;
use App\Domain\Interfaces\Repository\FleetRepositoryInterface;

final class RegisterFleetHandler implements RegisterFleetHandlerInterface
{
    /**
     * @param FleetRepositoryInterface $repository
     */
    public function __construct(private readonly FleetRepositoryInterface $repository)
    {
    }

    /**
     * @param RegisterFleetCommand $command
     * @return FleetInterface
     */
    public function __invoke(RegisterFleetCommand $command): FleetInterface
    {
        $fleet = new Fleet($command->userId);
        $this->repository->save($fleet);
        return $fleet;
    }
}