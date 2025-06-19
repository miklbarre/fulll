<?php

namespace App\Interfaces\Entity;

/**
 *
 */
interface LocationInterface
{
    /**
     * @param LocationInterface $location
     * @return bool
     */
    public function equals(LocationInterface $location): bool;
}