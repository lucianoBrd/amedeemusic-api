<?php

namespace App\Service;

class RandomService
{
    public function __construct(
    )
    {
    }

    public function getRandom(array $array, int $num): array {
        $length = count($array);

        if ($length == 0 || $length <= $num) {
            return $array;
        }
        
        return array_rand($array, $num);
    }
}
