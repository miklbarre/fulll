<?php

namespace App\Repository;

use App\Interfaces\Entity\FleetInterface;
use App\Interfaces\Repository\FleetRepositoryInterface;
use Doctrine\Common\Collections\ArrayCollection;

class FleetRepository implements FleetRepositoryInterface
{
    /**
     * @var ArrayCollection<FleetInterface>
     */
    private ArrayCollection $fleets;

    public function __construct()
    {
        $this->fleets = new ArrayCollection();
    }

    /**
     * @param FleetInterface $fleet
     * @return void
     */
    public function save(FleetInterface $fleet): void
    {
        $this->fleets->set($fleet->getFleetId(), $fleet);
    }

    /**
     * @param string $fleetId
     * @return FleetInterface|null
     */
    public function find(string $fleetId): ?FleetInterface
    {
        return $this->fleets->get($fleetId);
    }
}
