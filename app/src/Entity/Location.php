<?php

namespace App\Entity;

use App\Interfaces\Entity\LocationInterface;

/**
 *
 */
final class Location implements LocationInterface
{
    /**
     * @param float $lat
     * @param float $lng
     */
    public function __construct(
        public float $lat,
        public float $lng
    )
    {
    }

    /**
     * @param LocationInterface $location
     * @return bool
     */
    public function equals(LocationInterface $location): bool
    {
        return $this->lat === $location->lat && $this->lng === $location->lng;
    }
}
