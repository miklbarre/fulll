<?php

namespace App\Domain\Entity;;

use App\Domain\Interfaces\Entity\LocationInterface;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Embeddable]
class Location implements LocationInterface
{
    #[ORM\Column(type: 'float', nullable: true)]
    private ?float $latitude;

    #[ORM\Column(type: 'float', nullable: true)]
    private ?float $longitude;

    /**
     * @param float|null $lat
     * @param float|null $lng
     */
    public function __construct(
        public ?float $lat,
        public ?float $lng
    )
    {
        $this->latitude = $lat;
        $this->longitude = $lng;
    }

    /**
     * @param LocationInterface $location
     * @return bool
     */
    public function equals(LocationInterface $location): bool
    {
        return $this->latitude === $location->lat && $this->longitude === $location->lng;
    }
}
