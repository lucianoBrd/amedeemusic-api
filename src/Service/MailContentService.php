<?php

namespace App\Service;

class MailContentService
{
    public function __construct(
    )
    {
    }

    public function getBooksGroupedBy3(array $books): array {
        $booksGroupedBy3 = [];

        $j = 0;
        $i = 0;
        foreach ($books as $book) {
            if ($i % 3 == 0) {
                $j++;
            }
            $booksGroupedBy3['GROUPE' . $j][] = $book;
            $i++;
        }dump($booksGroupedBy3);
        return $booksGroupedBy3;
    }
}
