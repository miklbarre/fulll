<?php

namespace App\Entity;

use App\Interfaces\Entity\FleetInterface;
use App\Interfaces\Entity\LocationInterface;
use App\Interfaces\Entity\VehicleInterface;
use Exception;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'vehicle')]
class Vehicle implements VehicleInterface
{
    #[ORM\Id]
    #[ORM\Column(type: 'integer')]
    #[ORM\GeneratedValue(strategy: 'AUTO')]
    private int $id;

    #[ORM\Embedded(class: Location::class)]
    private ?LocationInterface $location = null;

    #[ORM\ManyToOne(targetEntity: Fleet::class, cascade: ['persist'], inversedBy: "vehicles")]
    #[ORM\JoinColumn(name: 'fleet_id', referencedColumnName: 'id', nullable: true)]
    protected Fleet $fleet;

    #[ORM\Column(type: 'string', length: 255)]
    private string $plateNumber;

    /**
     * @param string $plateNumber
     * @param Fleet $fleet
     */
    public function __construct(string $plateNumber, Fleet $fleet)
    {
        $this->plateNumber = $plateNumber;
        $this->fleet = $fleet;
    }

    /**
     * @return string
     */
    public function getPlateNumber(): string
    {
        return $this->plateNumber;
    }

    /**
     * @return LocationInterface|null
     */
    public function getLocation(): ?LocationInterface
    {
        return $this->location;
    }

    /**
     * @param LocationInterface $location
     * @return void
     * @throws Exception
     */
    public function parkAt(LocationInterface $location): void
    {
        if ($this->location && $this->location->equals($location)) {
            throw new Exception("Vehicle already parked");
        }
        $this->location = $location;
    }

    /**
     * @param Fleet $fleet
     * @return void
     */
    public function setFleet(Fleet $fleet): void
    {
        $this->fleet = $fleet;
    }

    /**
     * @return bool
     * @throws Exception
     */
    public function isAlreadyOnFleet(): bool
    {
        foreach ($this->fleet->getVehicles()->toArray() as $vehicle) {
            if ($vehicle->getPlateNumber() === $this->plateNumber) {
                return true;
            }
        }
        return false;

    }
}