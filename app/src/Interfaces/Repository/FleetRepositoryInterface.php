<?php

namespace App\Interfaces\Repository;

use App\Entity\Fleet;
use App\Interfaces\Entity\FleetInterface;

interface FleetRepositoryInterface
{
    /**
     * @param FleetInterface $fleet
     * @return void
     */
    public function save(FleetInterface $fleet): void;

    /**
     * @param int $fleetId
     * @return FleetInterface|null
     */
    public function findFleet(int $fleetId): ?FleetInterface;
}