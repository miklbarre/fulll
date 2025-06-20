<?php

namespace App\Domain\Interfaces\Entity;

/**
 *
 */
interface VehicleInterface
{
    /**
     * @return string
     */
    public function getPlateNumber(): string;

    /**
     * @return LocationInterface|null
     */
    public function getLocation(): ?LocationInterface;

    /**
     * @param LocationInterface $location
     * @return void
     */
    public function parkAt(LocationInterface $location): void;

    /**
     * @return bool
     */
    public function isAlreadyOnFleet(): bool;
}