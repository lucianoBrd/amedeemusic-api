<?php

namespace App\Controller\Api;

use App\Entity\Local;
use App\Entity\Project;
use App\Service\LocalGenerator;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[AsController]
class GetFilterProjectController extends AbstractController
{
    public function __construct(
        private EntityManagerInterface $entityManager,
        private LocalGenerator $localGenerator, 
    ) {}

    public function __invoke(Request $request)
    {
        $search = $request->query->get('search');
        $page = $request->query->get('page');
        $blogs = $this->entityManager->getRepository(Project::class)->findBySearch($search, $page);

        return $blogs;
    }
}
