<?php

namespace App\Entity;

use App\Entity\Data;
use ApiPlatform\Metadata\Get;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Metadata\ApiResource;
use App\Repository\GalleryRepository;
use ApiPlatform\Metadata\GetCollection;
use App\Controller\Api\GetLastsGalleryController;

#[ORM\Entity(repositoryClass: GalleryRepository::class)]
#[ApiResource(
    operations: [
        new GetCollection(
            name: 'lastsGallery', 
            uriTemplate: '/galleries/lasts', 
            controller: GetLastsGalleryController::class,
            read: false,
        ),
        new GetCollection(),
        new Get()
    ],
    order: ['id' => 'DESC'],
    paginationEnabled: true,
    paginationItemsPerPage: Data::PAGINATION_ITEMS_PER_PAGE
)]
class Gallery
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $image = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): self
    {
        $this->image = $image;

        return $this;
    }
}
