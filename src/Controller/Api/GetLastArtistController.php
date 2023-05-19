<?php

namespace App\Controller\Api;

use App\Entity\Artist;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[AsController]
class GetLastArtistController extends AbstractController
{
    public function __construct(
        private EntityManagerInterface $entityManager
    ) {}

    public function __invoke(): ?Artist
    {
        $artists = $this->entityManager->getRepository(Artist::class)->findBy([], ['id' => 'DESC'], 1);
        
        foreach ($artists as $artist) {
            return $artist;
        }
        return null;
    }
}
