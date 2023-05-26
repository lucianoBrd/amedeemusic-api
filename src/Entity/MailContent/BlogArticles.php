<?php

namespace App\Entity\MailContent;

use Doctrine\ORM\Mapping as ORM;
use App\Entity\MailContent\MailContent;
use Doctrine\Common\Collections\Collection;
use App\Entity\MailContent\BlogArticles\Article;
use App\Entity\MailContent\MailContentInterface;
use Doctrine\Common\Collections\ArrayCollection;
use App\Repository\MailContent\BlogArticlesRepository;

#[ORM\Entity(repositoryClass: BlogArticlesRepository::class)]
class BlogArticles extends MailContent implements MailContentInterface
{

    #[ORM\OneToMany(mappedBy: 'blogArticles', targetEntity: Article::class)]
    private Collection $articles;

    public function __construct()
    {
        $this->articles = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection<int, Article>
     */
    public function getArticles(): Collection
    {
        return $this->articles;
    }

    public function addArticle(Article $article): self
    {
        if (!$this->articles->contains($article)) {
            $this->articles->add($article);
            $article->setBlogArticles($this);
        }

        return $this;
    }

    public function removeArticle(Article $article): self
    {
        if ($this->articles->removeElement($article)) {
            // set the owning side to null (unless already changed)
            if ($article->getBlogArticles() === $this) {
                $article->setBlogArticles(null);
            }
        }

        return $this;
    }
}
