<?php

// src/Twig/AppExtension.php
namespace App\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class ClassTwigExtension extends AbstractExtension
{
    public function getFunctions()
    {
        return [
            new TwigFunction('getClass', [$this, 'getClass']),
        ];
    }

    public function getClass(?object $object): ?string
    {
        return get_class($object);
    }
}