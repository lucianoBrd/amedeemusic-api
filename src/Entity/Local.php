<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\LocalRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LocalRepository::class)]
#[ApiResource]
class Local
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $local = null;

    #[ORM\OneToMany(mappedBy: 'local', targetEntity: Testimonial::class, orphanRemoval: true)]
    private Collection $testimonials;

    #[ORM\OneToMany(mappedBy: 'local', targetEntity: Politic::class, orphanRemoval: true)]
    private Collection $politics;

    #[ORM\OneToMany(mappedBy: 'local', targetEntity: Event::class, orphanRemoval: true)]
    private Collection $events;

    #[ORM\OneToMany(mappedBy: 'local', targetEntity: Project::class, orphanRemoval: true)]
    private Collection $projects;

    #[ORM\OneToMany(mappedBy: 'local', targetEntity: Type::class, orphanRemoval: true)]
    private Collection $types;

    #[ORM\OneToMany(mappedBy: 'local', targetEntity: Title::class, orphanRemoval: true)]
    private Collection $titles;

    #[ORM\OneToMany(mappedBy: 'local', targetEntity: ArtistAbout::class, orphanRemoval: true)]
    private Collection $artistAbouts;

    #[ORM\OneToMany(mappedBy: 'local', targetEntity: VideoDescription::class, orphanRemoval: true)]
    private Collection $videoDescriptions;

    public function __construct()
    {
        $this->testimonials = new ArrayCollection();
        $this->politics = new ArrayCollection();
        $this->events = new ArrayCollection();
        $this->projects = new ArrayCollection();
        $this->types = new ArrayCollection();
        $this->titles = new ArrayCollection();
        $this->artistAbouts = new ArrayCollection();
        $this->videoDescriptions = new ArrayCollection();
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

    public function getLocal(): ?string
    {
        return $this->local;
    }

    public function setLocal(string $local): self
    {
        $this->local = $local;

        return $this;
    }

    /**
     * @return Collection<int, Testimonial>
     */
    public function getTestimonials(): Collection
    {
        return $this->testimonials;
    }

    public function addTestimonial(Testimonial $testimonial): self
    {
        if (!$this->testimonials->contains($testimonial)) {
            $this->testimonials->add($testimonial);
            $testimonial->setLocal($this);
        }

        return $this;
    }

    public function removeTestimonial(Testimonial $testimonial): self
    {
        if ($this->testimonials->removeElement($testimonial)) {
            // set the owning side to null (unless already changed)
            if ($testimonial->getLocal() === $this) {
                $testimonial->setLocal(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Politic>
     */
    public function getPolitics(): Collection
    {
        return $this->politics;
    }

    public function addPolitic(Politic $politic): self
    {
        if (!$this->politics->contains($politic)) {
            $this->politics->add($politic);
            $politic->setLocal($this);
        }

        return $this;
    }

    public function removePolitic(Politic $politic): self
    {
        if ($this->politics->removeElement($politic)) {
            // set the owning side to null (unless already changed)
            if ($politic->getLocal() === $this) {
                $politic->setLocal(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Event>
     */
    public function getEvents(): Collection
    {
        return $this->events;
    }

    public function addEvent(Event $event): self
    {
        if (!$this->events->contains($event)) {
            $this->events->add($event);
            $event->setLocal($this);
        }

        return $this;
    }

    public function removeEvent(Event $event): self
    {
        if ($this->events->removeElement($event)) {
            // set the owning side to null (unless already changed)
            if ($event->getLocal() === $this) {
                $event->setLocal(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Project>
     */
    public function getProjects(): Collection
    {
        return $this->projects;
    }

    public function addProject(Project $project): self
    {
        if (!$this->projects->contains($project)) {
            $this->projects->add($project);
            $project->setLocal($this);
        }

        return $this;
    }

    public function removeProject(Project $project): self
    {
        if ($this->projects->removeElement($project)) {
            // set the owning side to null (unless already changed)
            if ($project->getLocal() === $this) {
                $project->setLocal(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Type>
     */
    public function getTypes(): Collection
    {
        return $this->types;
    }

    public function addType(Type $type): self
    {
        if (!$this->types->contains($type)) {
            $this->types->add($type);
            $type->setLocal($this);
        }

        return $this;
    }

    public function removeType(Type $type): self
    {
        if ($this->types->removeElement($type)) {
            // set the owning side to null (unless already changed)
            if ($type->getLocal() === $this) {
                $type->setLocal(null);
            }
        }

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
            $title->setLocal($this);
        }

        return $this;
    }

    public function removeTitle(Title $title): self
    {
        if ($this->titles->removeElement($title)) {
            // set the owning side to null (unless already changed)
            if ($title->getLocal() === $this) {
                $title->setLocal(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, ArtistAbout>
     */
    public function getArtistAbouts(): Collection
    {
        return $this->artistAbouts;
    }

    public function addArtistAbout(ArtistAbout $artistAbout): self
    {
        if (!$this->artistAbouts->contains($artistAbout)) {
            $this->artistAbouts->add($artistAbout);
            $artistAbout->setLocal($this);
        }

        return $this;
    }

    public function removeArtistAbout(ArtistAbout $artistAbout): self
    {
        if ($this->artistAbouts->removeElement($artistAbout)) {
            // set the owning side to null (unless already changed)
            if ($artistAbout->getLocal() === $this) {
                $artistAbout->setLocal(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, VideoDescription>
     */
    public function getVideoDescriptions(): Collection
    {
        return $this->videoDescriptions;
    }

    public function addVideoDescription(VideoDescription $videoDescription): self
    {
        if (!$this->videoDescriptions->contains($videoDescription)) {
            $this->videoDescriptions->add($videoDescription);
            $videoDescription->setLocal($this);
        }

        return $this;
    }

    public function removeVideoDescription(VideoDescription $videoDescription): self
    {
        if ($this->videoDescriptions->removeElement($videoDescription)) {
            // set the owning side to null (unless already changed)
            if ($videoDescription->getLocal() === $this) {
                $videoDescription->setLocal(null);
            }
        }

        return $this;
    }
}
