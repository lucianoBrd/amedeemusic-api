<?php

namespace App\Controller\Api;

use App\Entity\Data;
use App\Entity\Project;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[AsController]
class GetLastsProjectController extends AbstractController
{
    public function __construct(
        private EntityManagerInterface $entityManager,
    ) {}

    public function __invoke(Request $request)
    {
        $projects = $this->entityManager->getRepository(Project::class)->findBy([], ['date' => 'DESC'], Data::PAGINATION_ITEMS_PER_PAGE_LASTS);

        return $projects;
    }
}
