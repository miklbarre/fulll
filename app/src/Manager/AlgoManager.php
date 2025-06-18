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
        $arrayToDisplay = [
            3 => 'Fizz',
            5 => 'Buzz'
        ];

        for ($i = 1; $i <= $index; $i++) {
            $output = '';
            foreach ($arrayToDisplay as $div => $word) {
                $output .= ($i % $div === 0) ? $word : '';
            }

            echo "$i" . ($output ? " - $output" : '') . "\r\n";
        }

        /*
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
        }*/

        return true;
    }
}