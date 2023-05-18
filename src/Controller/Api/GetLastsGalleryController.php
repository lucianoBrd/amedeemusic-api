<?php

namespace App\Controller\Api;

use App\Entity\Gallery;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[AsController]
class GetLastsGalleryController extends AbstractController
{
    public function __construct(
        private EntityManagerInterface $entityManager,
    ) {}

    public function __invoke(Request $request)
    {
        $galleries = $this->entityManager->getRepository(Gallery::class)->findBy([], ['id' => 'DESC'], 5);

        return $galleries;
    }
}
