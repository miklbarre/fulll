<?php

namespace App\Repository;

use App\Entity\Fleet;
use App\Interfaces\Entity\FleetInterface;
use App\Interfaces\Repository\FleetRepositoryInterface;

final class FleetRepository extends EntityRepository implements FleetRepositoryInterface
{
    protected static string $className = Fleet::class;

    /**
     * @param FleetInterface $fleet
     * @return void
     */
    public function save(FleetInterface $fleet): void
    {
        $this->persistAndFlush($fleet);
    }

    /**
     * @param int $fleetId
     * @return Fleet|null
     */
    public function findFleet(int $fleetId): ?Fleet
    {
        return $this->find($fleetId);
    }
}
