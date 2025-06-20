<?php

namespace App\App\Command;

final class RegisterFleetCommand
{
    /**
     * @param int $userId
     */
    public function __construct(
        public int $userId
    )
    {
    }
}
