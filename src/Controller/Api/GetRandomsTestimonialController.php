<?php

namespace App\Controller\Api;

use App\Entity\Data;
use App\Entity\Local;
use App\Entity\Testimonial;
use App\Service\RandomService;
use App\Service\LocalGenerator;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[AsController]
class GetRandomsTestimonialController extends AbstractController
{
    public function __construct(
        private EntityManagerInterface $entityManager,
        private LocalGenerator $localGenerator,
        private RandomService $randomService,
    ) {}

    public function __invoke(Request $request)
    {
        $local = $request->query->get('local_local');
        $local = $this->localGenerator->checkLocal($local);
        $local = $this->entityManager->getRepository(Local::class)->findOneBy(['local' => $local]);

        $testimonials = $this->entityManager->getRepository(Testimonial::class)->findBy(['local' => $local], ['id' => 'DESC']);

        return $this->randomService->getRandom($testimonials, Data::PAGINATION_ITEMS_PER_PAGE_LASTS);
    }
}
