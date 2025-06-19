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
     * @param float|null $alt
     */
    public function __construct(
        public readonly float $lat,
        public readonly float $lng,
        public readonly ?float $alt = null
    ) {}
}
