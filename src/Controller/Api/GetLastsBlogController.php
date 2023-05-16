<?php

namespace App\Controller\Api;

use App\Entity\Blog;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[AsController]
class GetLastsBlogController extends AbstractController
{
    public function __construct(
        private EntityManagerInterface $entityManager
    ) {}

    public function __invoke(): array
    {
        $blogs = $this->entityManager->getRepository(Blog::class)->findBy([], ['date' => 'DESC'], 5);

        return $blogs;
    }
}
