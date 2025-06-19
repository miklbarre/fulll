<?php

namespace App\Entity;

use App\Interfaces\Entity\FleetInterface;
use App\Interfaces\Entity\VehicleInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Exception;

class Fleet implements FleetInterface
{
    /**
     * @var ArrayCollection<VehicleInterface>
     */
    private ArrayCollection $vehicles;

    /**
     * @param string $fleetId
     */
    public function __construct(private string $fleetId)
    {
        $this->vehicles = new ArrayCollection();
    }

    /**
     * @return string
     */
    public function getFleetId(): string
    {
        return $this->fleetId;
    }

    /**
     * @param VehicleInterface $vehicle
     * @return void
     * @throws Exception
     */
    public function addVehicle(VehicleInterface $vehicle): void
    {
        if ($this->vehicles->contains($vehicle)) {
            throw new Exception("Vehicle already added in the fleet");
        }

        $this->vehicles->add($vehicle);
    }

    /**
     * @param VehicleInterface $vehicle
     * @return bool
     */
    public function hasVehicle(VehicleInterface $vehicle): bool
    {
        return $this->vehicles->contains($vehicle);
    }
}
