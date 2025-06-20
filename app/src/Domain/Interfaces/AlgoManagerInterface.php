<?php

namespace App\Domain\Interfaces;

interface AlgoManagerInterface
{
    /**
     * @param int $index
     * @return bool
     */
    public function algo(int $index = 100): bool;
}