<?php

namespace App\Entity;

use App\Interfaces\Entity\FleetInterface;
use App\Interfaces\Entity\VehicleInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Exception;

#[ORM\Entity]
#[ORM\Table(name: 'fleet')]
class Fleet implements FleetInterface
{
    #[ORM\OneToMany(targetEntity: Vehicle::class, mappedBy: 'fleet', cascade: ['persist'], orphanRemoval: true)]
    protected Collection $vehicles;

    #[ORM\Id]
    #[ORM\Column(type: 'integer')]
    #[ORM\GeneratedValue(strategy: 'AUTO')]
    private int $id;

    #[ORM\Column(name: 'user_id', type: 'integer')]
    private int $userId;

    /**
     * @param int $userId
     */
    public function __construct(int $userId)
    {
        $this->userId = $userId;
        $this->vehicles = new ArrayCollection();
    }

    /**
     * @return int
     */
    public function getFleetId(): int
    {
        return $this->id;
    }

    /**
     * @param VehicleInterface $vehicle
     * @return void
     * @throws Exception
     */
    public function addVehicle(VehicleInterface $vehicle): void
    {
        if ($vehicle->isAlreadyOnFleet()) {
            throw new Exception("Vehicle already added in the fleet");
        }

        $this->vehicles->set($vehicle->getPlateNumber(), $vehicle);
    }

    /**
     * @param VehicleInterface $vehicle
     * @return bool
     */
    public function hasVehicle(VehicleInterface $vehicle): bool
    {
        return $this->vehicles->contains($vehicle);
    }


    /**
     * @param string $plateNumber
     * @return VehicleInterface|null
     */
    public function getVehicle(string $plateNumber): ?VehicleInterface
    {
        return $this->vehicles->get($plateNumber) ?? null;
    }

    /**
     * @return Collection
     */
    public function getVehicles(): Collection
    {
        return $this->vehicles;
    }
}
