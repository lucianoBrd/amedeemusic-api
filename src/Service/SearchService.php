<?php

namespace App\Service;

class SearchService
{
    public function __construct(
    )
    {
    }

    public function explodeStringByWhitespace(string $search): array {
        return preg_split("@[\s+　]@u", trim($search));
    }
}
