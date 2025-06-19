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
     * @param string $fleetId
     * @return FleetInterface|null
     */
    public function find(string $fleetId): ?FleetInterface;
}