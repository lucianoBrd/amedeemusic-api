<?php

namespace App\Entity\MailContent;

use Doctrine\ORM\Mapping as ORM;
use App\Entity\MailContent\JobBoard;
use App\Entity\MailContent\EventPlan;
use App\Entity\MailContent\FreeGoods;
use App\Entity\MailContent\MonthStats;
use App\Entity\MailContent\Shared\Text;
use App\Entity\MailContent\BlogArticles;
use App\Entity\MailContent\PricingTable;
use App\Entity\MailContent\UserWelcoming;
use App\Entity\MailContent\BookSuggestion;
use App\Entity\MailContent\EventSuggestion;
use Doctrine\Common\Collections\Collection;
use App\Entity\MailContent\PlaylistSuggestion;
use App\Entity\MailContent\MailContentInterface;
use Doctrine\Common\Collections\ArrayCollection;
use App\Repository\MailContent\MailContentRepository;

#[ORM\Entity(repositoryClass: MailContentRepository::class)]
#[ORM\InheritanceType('SINGLE_TABLE')]
#[ORM\DiscriminatorColumn(name: 'discr', type: 'string')]
#[ORM\DiscriminatorMap([
    'mail_content' => MailContent::class, 
    'blog_articles' => BlogArticles::class,
    'book_suggestion' => BookSuggestion::class,
    'event_plan' => EventPlan::class,
    'event_suggestion' => EventSuggestion::class,
    'free_goods' => FreeGoods::class,
    'job_board' => JobBoard::class,
    'month_stats' => MonthStats::class,
    'playlist_suggestion' => PlaylistSuggestion::class,
    'pricing_table' => PricingTable::class,
    'user_welcoming' => UserWelcoming::class,
])]
class MailContent implements MailContentInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    protected ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    protected ?string $title = null;

    #[ORM\Column(length: 255, nullable: true)]
    protected ?string $titleBold = null;

    #[ORM\Column(length: 255, nullable: true)]
    protected ?string $color = null;

    #[ORM\OneToMany(mappedBy: 'mailContent', targetEntity: Text::class, cascade: ['persist', 'remove'])]
    protected Collection $texts;

    public function __construct()
    {
        $this->texts = new ArrayCollection();
        $this->color = '292929';
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

    public function getTitleBold(): ?string
    {
        return $this->titleBold;
    }

    public function setTitleBold(?string $titleBold): self
    {
        $this->titleBold = $titleBold;

        return $this;
    }

    public function getColor(): ?string
    {
        return $this->color;
    }

    public function setColor(?string $color): self
    {
        $this->color = $color;

        return $this;
    }

    /**
     * @return Collection<int, Text>
     */
    public function getTexts(): Collection
    {
        return $this->texts;
    }

    public function addText(Text $text): self
    {
        if (!$this->texts->contains($text)) {
            $this->texts->add($text);
            $text->setMailContent($this);
        }

        return $this;
    }

    public function removeText(Text $text): self
    {
        if ($this->texts->removeElement($text)) {
            // set the owning side to null (unless already changed)
            if ($text->getMailContent() === $this) {
                $text->setMailContent(null);
            }
        }

        return $this;
    }
}
