<?php

namespace App\Controller\Api;

use App\Entity\Data;
use App\Entity\Event;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[AsController]
class GetLastsEventController extends AbstractController
{
    public function __construct(
        private EntityManagerInterface $entityManager,
    ) {}

    public function __invoke(Request $request)
    {
        $events = $this->entityManager->getRepository(Event::class)->findBy([], ['date' => 'DESC'], Data::PAGINATION_ITEMS_PER_PAGE_LASTS);

        return $events;
    }
}
