<?php

namespace App\Service;

class MailContentService
{
    public function __construct(
    )
    {
    }

    public function getGroupedBy(array $array, int $number = 2): array {
        $arrayGroupedBy = [];

        $j = 0;
        $i = 0;
        foreach ($array as $item) {
            if ($i % $number == 0) {
                $j++;
            }
            $arrayGroupedBy['GROUPE' . $j][] = $item;
            $i++;
        }
        return $arrayGroupedBy;
    }
}
