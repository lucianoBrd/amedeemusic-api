<?php

namespace App\Controller\Api;

use App\Entity\Event;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[AsController]
class GetFilterEventController extends AbstractController
{
    public function __construct(
        private EntityManagerInterface $entityManager,
    ) {}

    public function __invoke(Request $request)
    {
        $search = $request->query->get('search');
        $page = $request->query->get('page');
        $projects = $this->entityManager->getRepository(Event::class)->findBySearch($search, $page);

        return $projects;
    }
}
