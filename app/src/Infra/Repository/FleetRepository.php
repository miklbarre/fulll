<?php

namespace App\Infra\Repository;

use App\Domain\Entity\Fleet;
use App\Domain\Interfaces\Entity\FleetInterface;
use App\Domain\Interfaces\Repository\FleetRepositoryInterface;

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
