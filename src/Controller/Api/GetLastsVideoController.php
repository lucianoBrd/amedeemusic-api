<?php

namespace App\Controller\Api;

use App\Entity\Data;
use App\Entity\Video;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[AsController]
class GetLastsVideoController extends AbstractController
{
    public function __construct(
        private EntityManagerInterface $entityManager,
    ) {}

    public function __invoke(Request $request)
    {
        $videos = $this->entityManager->getRepository(Video::class)->findBy([], ['id' => 'DESC'], Data::PAGINATION_ITEMS_PER_PAGE / 2);

        return $videos;
    }
}
