<?php

namespace App\Manager;

use App\Interfaces\AlgoManagerInterface;

/**
 *
 */
class AlgoManager implements AlgoManagerInterface
{
    /**
     * @param int $index
     * @return bool
     */
    public function algo(int $index = 100): bool
    {
        for ($i = 1; $i <= $index; $i++) {
            $output = "$i";
            if ($i % 5 === 0 && $i % 3 === 0) {
                $output .= "- FizzBuzz";
            } else if ($i % 5 === 0) {
                $output .= "- Buzz";
            } else if ($i % 3 === 0) {
                $output .= "- Fizz";
            }
            echo $output . "\r\n";
        }

        return true;
    }
}