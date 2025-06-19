<?php

namespace App\Handler;

use App\Command\RegisterFleetCommand;
use App\Entity\Fleet;
use App\Interfaces\Handler\RegisterFleetHandlerInterface;
use App\Interfaces\Repository\FleetRepositoryInterface;
use Exception;

final class RegisterFleetHandler implements RegisterFleetHandlerInterface
{
    /**
     * @param FleetRepositoryInterface $repository
     */
    public function __construct(private FleetRepositoryInterface $repository)
    {
    }

    /**
     * @param RegisterFleetCommand $command
     * @return void
     * @throws Exception
     */
    public function __invoke(RegisterFleetCommand $command): void
    {

        $fleet = new Fleet($command->userId);
        $this->repository->save($fleet);
    }
}