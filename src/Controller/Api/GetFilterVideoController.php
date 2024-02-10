<?php

namespace App\Controller\Api;

use App\Entity\Video;
use App\Service\LocalGenerator;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[AsController]
class GetFilterVideoController extends AbstractController
{
    public function __construct(
        private EntityManagerInterface $entityManager,
        private LocalGenerator $localGenerator, 
    ) {}

    public function __invoke(Request $request)
    {
        $local = $request->query->get('local_local');
        $local = $this->localGenerator->checkLocal($local);

        $search = $request->query->get('search');
        $page = $request->query->get('page');
        $videos = $this->entityManager->getRepository(Video::class)->findBySearch($local, $search, $page);

        return $videos;
    }
}
