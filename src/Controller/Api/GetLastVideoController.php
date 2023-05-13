<?php

namespace App\Controller\Api;

use App\Entity\Video;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[AsController]
class GetLastVideoController extends AbstractController
{
    public function __construct(
        private EntityManagerInterface $entityManager
    ) {}

    public function __invoke(): ?Video
    {
        $videos = $this->entityManager->getRepository(Video::class)->findBy([], ['id' => 'DESC']);
        
        foreach ($videos as $video) {
            return $video;
        }
        return null;
    }
}
