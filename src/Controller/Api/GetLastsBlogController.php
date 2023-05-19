<?php

namespace App\Controller\Api;

use App\Entity\Blog;
use App\Entity\Data;
use App\Entity\Local;
use App\Service\LocalGenerator;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[AsController]
class GetLastsBlogController extends AbstractController
{
    public function __construct(
        private EntityManagerInterface $entityManager,
        private LocalGenerator $localGenerator, 
    ) {}

    public function __invoke(Request $request)
    {
        $local = $request->query->get('local_local');
        $local = $this->localGenerator->checkLocal($local);
        $local = $this->entityManager->getRepository(Local::class)->findOneBy(['local' => $local]);

        $blogs = $this->entityManager->getRepository(Blog::class)->findBy(['local' => $local], ['date' => 'DESC'], Data::PAGINATION_ITEMS_PER_PAGE_LASTS);

        return $blogs;
    }
}
