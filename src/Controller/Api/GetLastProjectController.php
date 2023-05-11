<?php

namespace App\Controller\Api;

use App\Entity\Project;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[AsController]
class GetLastProjectController extends AbstractController
{
    public function __construct(
        private EntityManagerInterface $entityManager
    ) {}

    public function __invoke(): ?Project
    {
        $projects = $this->entityManager->getRepository(Project::class)->findBy([], ['date' => 'DESC']);
        
        foreach ($projects as $project) {
            return $project;
        }
        return null;
    }
}
