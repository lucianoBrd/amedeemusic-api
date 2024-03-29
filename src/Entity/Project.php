<?php

namespace App\Entity;

use App\Entity\Data;
use ApiPlatform\Metadata\Get;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Metadata\ApiProperty;
use ApiPlatform\Metadata\ApiResource;
use App\Repository\ProjectRepository;
use ApiPlatform\Metadata\GetCollection;
use Doctrine\Common\Collections\Collection;
use App\Controller\Api\GetLastProjectController;
use Doctrine\Common\Collections\ArrayCollection;
use App\Controller\Api\GetLastsProjectController;
use App\Controller\Api\GetFilterProjectController;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: ProjectRepository::class)]
#[ApiResource(
    operations: [
        new GetCollection(
            name: 'lastsProject', 
            uriTemplate: '/projects/lasts', 
            controller: GetLastsProjectController::class,
            read: false,
            normalizationContext: ['groups' => 'project:read:collection']
        ),
        new GetCollection(
            name: 'filterProject', 
            uriTemplate: '/projects/filter', 
            controller: GetFilterProjectController::class,
            read: false,
            normalizationContext: ['groups' => 'project:read:collection']
        ),
        new GetCollection(
            normalizationContext: ['groups' => 'project:read:collection']
        ),
        new Get(
            name: 'lastProjectLight', 
            uriTemplate: '/projects/last/light', 
            controller: GetLastProjectController::class,
            read: false,
            normalizationContext: ['groups' => 'project:read:light']
        ),
        new Get(
            normalizationContext: ['groups' => 'project:read']
        ),
    ],
    order: ['date' => 'DESC'],
    paginationEnabled: true,
    paginationItemsPerPage: Data::PAGINATION_ITEMS_PER_PAGE
)]
class Project
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['project:read', 'project:read:light', 'project:read:collection'])]
    #[ApiProperty(identifier: false)]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(['project:read', 'project:read:light', 'project:read:collection'])]
    private ?string $name = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    #[Groups(['project:read', 'project:read:light', 'project:read:collection'])]
    private ?\DateTimeInterface $date = null;

    #[ORM\Column(length: 255)]
    #[Groups(['project:read', 'project:read:light', 'project:read:collection'])]
    private ?string $image = null;

    #[ORM\OneToMany(mappedBy: 'project', targetEntity: Title::class, orphanRemoval: true, cascade: ['persist', 'remove'])]
    #[Groups(['project:read'])]
    private Collection $titles;

    #[ORM\OneToMany(mappedBy: 'project', targetEntity: ProjectPlatform::class, cascade: ['persist', 'remove'])]
    #[Groups(['project:read'])]
    private Collection $projectPlatforms;

    #[ORM\ManyToOne(inversedBy: 'projects')]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(['project:read', 'project:read:collection'])]
    private ?Type $type = null;

    #[ORM\Column(length: 350, unique: true)]
    #[Groups(['project:read', 'project:read:light', 'project:read:collection'])]
    #[ApiProperty(identifier: true)]
    private ?string $slug = null;

    public function __construct()
    {
        $this->titles = new ArrayCollection();
        $this->projectPlatforms = new ArrayCollection();
    }

    public function __toString(): string
    {
        return $this->name;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
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

    /**
     * @return Collection<int, Title>
     */
    public function getTitles(): Collection
    {
        return $this->titles;
    }

    public function addTitle(Title $title): self
    {
        if (!$this->titles->contains($title)) {
            $this->titles->add($title);
            $title->setProject($this);
        }

        return $this;
    }

    public function removeTitle(Title $title): self
    {
        if ($this->titles->removeElement($title)) {
            // set the owning side to null (unless already changed)
            if ($title->getProject() === $this) {
                $title->setProject(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, ProjectPlatform>
     */
    public function getProjectPlatforms(): Collection
    {
        return $this->projectPlatforms;
    }

    public function addProjectPlatform(ProjectPlatform $projectPlatform): self
    {
        if (!$this->projectPlatforms->contains($projectPlatform)) {
            $this->projectPlatforms->add($projectPlatform);
            $projectPlatform->setProject($this);
        }

        return $this;
    }

    public function removeProjectPlatform(ProjectPlatform $projectPlatform): self
    {
        if ($this->projectPlatforms->removeElement($projectPlatform)) {
            // set the owning side to null (unless already changed)
            if ($projectPlatform->getProject() === $this) {
                $projectPlatform->setProject(null);
            }
        }

        return $this;
    }

    public function getType(): ?Type
    {
        return $this->type;
    }

    public function setType(?Type $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }
}
