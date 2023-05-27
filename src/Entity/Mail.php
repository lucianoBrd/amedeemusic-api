<?php

namespace App\Entity;

use App\Entity\MailContent\MailContent;
use DateTime;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\MailRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: MailRepository::class)]
class Mail
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 500, nullable: true)]
    #[Assert\NotBlank]
    private ?string $title = null;

    #[ORM\ManyToMany(targetEntity: User::class, inversedBy: 'mails')]
    private Collection $recipients;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $recipientsString = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $date = null;

    #[ORM\ManyToOne(cascade: ['persist', 'remove'])]
    private ?MailContent $mailContent = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $template = null;

    #[ORM\Column]
    private ?bool $sent = null;

    public function __construct()
    {
        $this->recipients = new ArrayCollection();
        $this->date = new DateTime('now');
        $this->sent = false;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(?string $title): self
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @return Collection<int, User>
     */
    public function getRecipients(): Collection
    {
        return $this->recipients;
    }

    public function addRecipient(User $recipient): self
    {
        if (!$this->recipients->contains($recipient)) {
            $this->recipients->add($recipient);
        }

        return $this;
    }

    public function removeRecipient(User $recipient): self
    {
        $this->recipients->removeElement($recipient);

        return $this;
    }

    public function getRecipientsString(): ?string
    {
        return $this->recipientsString;
    }

    public function setRecipientsString(?string $recipientsString): self
    {
        $this->recipientsString = $recipientsString;

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

    public function getMailContent(): ?MailContent
    {
        return $this->mailContent;
    }

    public function setMailContent(?MailContent $mailContent): self
    {
        $this->mailContent = $mailContent;

        return $this;
    }

    public function getTemplate(): ?string
    {
        return $this->template;
    }

    public function setTemplate(?string $template): self
    {
        $this->template = $template;

        return $this;
    }

    public function isSent(): ?bool
    {
        return $this->sent;
    }

    public function setSent(bool $sent): self
    {
        $this->sent = $sent;

        return $this;
    }
}
